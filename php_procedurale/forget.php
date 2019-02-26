<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

/**
 * Traitement du formulaire d'inscription
 */
$error = null;
$db = db();

if (isset($_POST["forget"])) {
    extract($_POST);

    $find_email = find_user("email");

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Entrez une adresse E-mail valide!";
    } elseif ($email !== mb_strtolower($find_email->email)) {
        $error = "Cette adresse E-mail n'existe pas, <a href='/register.php'>inscrivez-vous</a>";
    } elseif (mb_strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères!";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne sont pas identiques!";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);

        $req = $db->prepare("UPDATE users SET password = :password WHERE email = :email");

        $update_password = $req->execute([
            "password" => $password,
            "email"     => $find_email->email
        ]);

        if ($update_password) {
            set_flash("Votre mot de passe a été modifié avec succès!", "success");
            redirect_to('/login.php');
        } else {
            set_flash("Une erreur inattendue est survenue!", "danger");
            redirect_to('/index.php');
        }
    }
}

/**
 * Entete du fichier
 */
$title = "Mot de passe oublié?";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'forget.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 