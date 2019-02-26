<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
//Exit not connected user in this page
is_not_connected();

$db = db();
$table = "chat";
$file = "minichat.php";

if (isset($_POST["chat"])) {

    array_pop($_POST);
    extract($_POST);



    if (empty($pseudo) && empty($message)) {
        $error = "Veuillez renseigner tous les champs svp!";
    } else {
        $req = $db->prepare("INSERT INTO chat(pseudo, message) VALUES(:pseudo, :message)");
        $req->execute([
            'pseudo' => strip_tags($pseudo),
            'message' => strip_tags($message)
        ]);

        $req->closeCursor();
    }
}



include_once __DIR__ . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "_pagination.php";

//Recuperation des informations du chat en BDD
$select = $db->query("SELECT id, pseudo, message, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i:%s') AS chat_date
                        FROM chat
                        ORDER BY id DESC
                        LIMIT $offset, $numberElementsByPage");




isset($_POST['refresh']) ? header('Refresh:3') : ''; //Permet de rafraichir la page automatiquement toutes les 3 secondes (ici)

$title = "Mini-chat";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'minichat.view.php';


require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';