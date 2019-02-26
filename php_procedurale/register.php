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
 * Traitement du formulaire d'inscription
 */
$error = "";
$db = db();

$user_infos = user_infos_completed($id);
$user_role = find_user_role($id);

$find_username = find_user('username');
$find_email = find_user('email');


if (isset($_POST["registration"])) {
    extract($_POST);

    if (empty($username) || mb_strlen($username) < 3) {
        $error = "Votre nom d'utilisateur doit contenir au moins 3 caractères!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Entrez une adresse E-mail valide!";
    } elseif (mb_strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères!";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne sont pas identiques!";
    } elseif (mb_strtolower($find_username->username)) {
        $error = "Ce nom d'utilisateur existe. Avez-vous oublié votre <a href='/forget.php'>mot de passe?</a>, 
                    sinon <a href='/login.php'>connectez-vous</a>";
    } elseif (mb_strtolower($find_email->email)) {
        $error = "Cette adresse E-mail existe. Avez-vous oublié votre <a href='/forget.php'>mot de passe?</a>, 
                    sinon <a href='/login.php'>connectez-vous</a>";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $ip = $_SERVER["REMOTE_ADDR"];

        $req = $db->prepare("INSERT INTO users(roles_id, ui_id, username, email, password, ip) 
                        VALUES(:roles_id, :ui_id, :username, :email, :password, :ip)
                    ");

        $insert = $req->execute([
            "roles_id" => $user_role->id,
            "ui_id" => $user_infos->id,
            "username" => $username,
            "email" => mb_strtolower($email),
            "password" => $password,
            "ip" => $ip
        ]);

        if ($insert) {
            set_flash("Votre inscription a été prise en compte avec succès!", "success");
            redirect_to("/login.php");
        } else {
            set_flash("Une erreur inattendue est survenue lors de votre inscription!", "danger");
            redirect_to("/index.php");
        }
    }
}

/**
 * Entete du fichier
 */
$title = "Inscription";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'register.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 