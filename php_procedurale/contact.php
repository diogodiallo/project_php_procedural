<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$error = null;

ini_set("SMTP", "salioudiogo@gmail.com");
ini_set("smtp_port", 25);

if (isset($_POST['contact']) && !empty($_POST['contact'])) {
    extract($_POST);

    if (empty(trim($last_name)) || empty(trim($first_name))) {
        $error = 'Veuillez renseigner votre nom et/ou prénom svp!';
    } else if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Veuillez renseigner une adresse E-mail valide svp!';
    } else if (empty(trim($object))) {
        $error = 'Veuillez renseigner l\'objet de votre message svp!';
    }else {

            $from = 'From : ' . htmlentities($email);
            $header = "Content-type: text/html; charset=utf-8" . " \r\n";
            $header .= "From: " . $last_name . " " . $first_name . " <" . $from . "> \r\n";
            $header .= "MIME-Version: 1.0 \r\n";
            $header .= "Content-Transfer-Encoding: \r\n";

            $to = 'salioudiogo@gmail.com' . ' destiné à : ' . htmlentities($recipient);

            $subject = htmlentities($object);
            $message = htmlentities(trim($message));

            if (mail($to, $subject, $message, $header)) {
                
                $db = db();

                $req = $db->prepare("INSERT INTO contacts(email, lastname, firstname, object, recipient, message) 
                                        VALUES(?,?,?,?,?,?)");
                $insert = $req->execute([
                    $email, $last_name, $first_name, 
                    $subject, $recipient??'Secrétaire', $message
                ]);

                if ($insert) {
                    set_flash('Nous avons reçu votre message et nous vous en remercions. On se dépêche de vous répondre.', 'success');
                    redirect_to('index.php');
                }else {
                    set_flash('Une erreur est survenue lors de la soumission de votre message.', 'danger');
                    redirect_to('index.php');
                }
            }
    }
}

$title = "Nous contactez";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'contact.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 