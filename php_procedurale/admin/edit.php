<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$db = db();

$req = $db->query("SELECT id, title, content, photos, DATE_FORMAT(created_at, '%d-%m-%Y %Hh%imn%ss') AS post_date
                    FROM news
                    ORDER BY created_at DESC");
$post = $req->fetch(PDO::FETCH_OBJ);

// Mise a jour de l'article
if (isset($_POST["edit"])) {
    array_pop($_POST);
    extract($_POST);

    if (isset($title, $content) && empty($title) && empty($content)) {
        $error = "Veuillez renseigner tous les champs, svp!";
    } else if (($title === $post->title) || ($content === $post->content)) {
        $error = "Vous n'avez fait aucune modification.";
    } else {
        $request = $db->prepare("UPDATE news SET title = :title, content = :content, photos = :photos WHERE id = :id");
        $request->execute([
            "title" => $title,
            "content" => $content,
            "photos" => $post->photos,
            "id" => (int)$_GET["edit"]
        ]);

        set_flash("Cet article a été modifié avec succès!", "success");
        redirect_to("index.php");
    }
}

// Entete du fichier
$title = "Edition " . $post->title;
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'edit.view.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 