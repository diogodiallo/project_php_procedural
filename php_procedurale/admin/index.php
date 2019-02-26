<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
//Exit not connected user in this page
is_not_connected();

if (($_SESSION['connected']['level'] < 2)) {
    redirect_to("../profile.php?id=" . get_session('id'));
}

$db = db();
$req = $db->query("SELECT id, title, content, DATE_FORMAT(created_at, '%d-%m-%Y %Hh%imn%ss') AS post_date 
                    FROM news ORDER BY post_date DESC");

$query = $db->query("SELECT id, news_id, valid, author, comment, DATE_FORMAT(created_at, '%d-%m-%Y %Hh%imn%ss') 
                    AS comment_date FROM comments ORDER BY comment_date DESC");

$sql = $db->query("SELECT * FROM contacts ORDER BY created_at DESC");

// Suppression de l'article
if (isset($_GET["delete"]) && (int)$_GET["delete"]) {
    $delete = $db->exec("DELETE FROM news WHERE id = " . (int)$_GET["delete"]);
    if ($delete) {
        set_flash("Votre article a été supprimé avec succès!", "success");
        redirect_to("index.php");
    }
}

// Suppression commentaire
if (isset($_GET["del_com"]) && (int)$_GET["del_com"]) {
    $delete_comment = $db->exec("DELETE FROM comments WHERE id = " . (int)$_GET["del_com"]);
    if ($delete_comment) {
        set_flash("Ce commentaire a été supprimé avec succès!", "success");
        redirect_to("index.php");
    }
}

$title = "Espace d'administration";
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'index.view.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 