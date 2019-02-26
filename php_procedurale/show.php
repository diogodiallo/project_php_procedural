<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$id = (int)$_GET["id"];

// Debut partie modele
$db = db();

// Recuperation des news (posts)
$sql = "SELECT n.id, user_id, username, title, content, photos, 
        DATE_FORMAT(n.created_at, '%d/%m/%Y %Hh%imn%ss') AS post_date
        FROM news AS n
        LEFT JOIN users AS u
          ON u.id = user_id
        WHERE n.id=?
        ORDER BY n.created_at DESC";

$req = $db->prepare($sql);
$req->execute([$id]);
$post = $req->fetch(PDO::FETCH_OBJ);
$req->closeCursor();
/**
 * Entete du fichier
 */
$title = $post->title;
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'show.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 