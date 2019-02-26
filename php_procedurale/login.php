<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
//Exit connected user in this page
if (is_connected()) {
    redirect_to('/admin/index.php');
}
/**
 * Traitement du fichier d'inscription
 */
$error = null;
$db = db();
$req = $db->prepare("SELECT * 
                    FROM users
                    WHERE (email = :identifiant || username = :identifiant)
                ");

if (isset($_POST['connection'])) {
    extract($_POST);

    $req->execute([
        "identifiant" => $identifiant,
    ]);

    if (empty($identifiant)) {
        $error = "Veuillez renseigner votre identifiant (pseudo ou email).";
    } else if (empty($password)) {
        $error = "Veuillez renseigner votre mot de passe.";
    } else {
        $user = $req->fetch(PDO::FETCH_OBJ);

        $user_role = find_user_role($user->id);

        if ((password_verify($password, $user->password))) {
            $_SESSION['connected']['id'] = $user->id;
            $_SESSION['connected']['username'] = $user->username;
            $_SESSION['connected']['email'] = $user->email;

            $_SESSION['connected']['level'] = $user_role->level;

            if ($_SESSION['connected']['level'] > 1) {
                set_flash("Vous etes bien connecte.", "success");
                redirect_to('/admin/index.php');
            } else {
                set_flash("Bienvenue sur votre espace membre $user->username", "success");
                redirect_to("/profile.php?id=$user->id");
            }
        } else {
            $error = "Vos identifiants sont incorrects.";
        }
    }
}

/**
 * Entete du fichier
 */
$title = "Connexion";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'login.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 