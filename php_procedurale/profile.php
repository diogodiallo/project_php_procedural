<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
//Exit not connected user in this page
is_not_connected();

$id = (int)$_GET['id'];
//$session_id = get_session('id');
$error = null;

$db = db();

// $user = find_user_by_id($id);

if (!empty($id) && $id === (int)get_session('id')) {
    $user = find_user_by_id($id);
    if (!$user) {
        redirect_to('login.php');
    }
} else {
    redirect_to("profile.php?id=" . get_session('id'));
}


//Complement d'informations utilisateur
//$user_infos = user_infos_completed($id);

//Role et niveau de l'utilisateur
$user_role = find_user_role($id);

// Get user by id
$user = find_user_by_id($id);


// Update pseudo
if (isset($_POST["pseudo"])) {
    extract($_POST);
    array_pop($_POST);
    $pseudo_error = '';

    if (empty($pseudo)) {
        $pseudo_error = 'Vous devez renseigner le pseudo ou le changer!';
    } else {
        $sql = $db->prepare("UPDATE users SET username = :username WHERE id = :id");
        $sql->execute([
            "username" => $username,
            "id" => get_session('id')
        ]);
        set_flash("Votre nom d'utilisateur a été modifié avec succès!", "success");
        redirect_to('/logout.php');
    }
}

// Update password
if (isset($_POST["pass"])) {
    extract($_POST);
    array_pop($_POST);
    $password_error = '';

    if (empty($password) || $password === $user->password) {
        $password_error = 'Vous devez renseigner le password ou le changer!';
    } else if (empty($old_password) && !password_verify($old_password, $user->password)) {
        $password_error = "Votre ancien mot de passe n'est pas bon. L'avez-vous <a href='#'>oublié?</a>";
    } else {
        $sql = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $sql->execute([
            "password" => password_hash($password, PASSWORD_BCRYPT),
            "id" => get_session('id')
        ]);
        set_flash("Votre mot de passe a été modifié avec succès!", "success");
        redirect_to("/logout.php");
    }
}


//Suppression du profil du membre connecte
if (isset($_POST['delete_user_count'])) {
    $query = $db->prepare("DELETE FROM users WHERE id = :id");
    $delete = $query->execute(["id" => $id]);

    if ($delete) {
        set_flash("Votre profile à été supprimer avec succès.", "success");
        redirect_to("/logout.php");
    }
}

//Complete profil
if (isset($_POST['complete'])) {
    extract($_POST);
    array_pop($_POST);

    if (mb_strlen(trim($lastname)) < 3) {
        $error = "Le nom de famille doit contenir au moins 3 caractères!";
    } elseif (mb_strlen(trim($firstname)) < 3) {
        $error = "Le prénom doit contenir au moins 3 caractères!";
    } else if (mb_strlen(trim($biography)) < 10) {
        $error = "Votre biographie doit contenir au moins 10 caractéres!";
    } elseif (
        ($firstname === $user->firstname) || ($lastname === $user->lastname)
        || ($gender === $user->gender) || ($biography === $user->biography)
    ) {
        $query = $db->prepare("UPDATE user_infos SET lastname = :lastname, firstname = :firstname
                                    gender = :gender, biography = :biography
                                WHERE id = :id
                            ");
        $update_infos = $query->execute([
            "lastname" => $lastname,
            "firstname" => $firstname,
            "gender" => $gender,
            "biography" => $biography,
            "id" => $id
        ]);
        set_flash("Votre profil a été modifié avec succès!", "success");
    } else {
        $query = $db->prepare("INSERT INTO user_infos(lastname, firstname, gender, biography)
                                VALUES(:lastname, :firstname, :gender, :biography)
                            ");

        $query->execute([
            "lastname" => $lastname,
            "firstname" => $firstname,
            "gender" => $gender,
            "biography" => $biography
        ]);

        set_flash("Votre profile a été complété avec succès!", "success");
        redirect_to('/index.php');
    }
}

$user_infos = user_infos_completed($id);

$title = "Mon profile";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'profile.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';