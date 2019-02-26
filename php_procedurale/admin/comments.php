<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$db = db();

$comment_id = (int)$_GET["comment"];



$req = $db->query("SELECT n.id, c.id, news_id, author, comment, DATE_FORMAT(c.created_at, '%d-%m-%Y %Hh%imn%ss') AS comment_date
                    FROM comments c
                    LEFT JOIN news n
                        ON n.id = news_id
                    WHERE c.id = $comment_id
                    ORDER BY comment_date DESC
                ");
$comment = $req->fetch(PDO::FETCH_OBJ);

// Mise a jour de l'article
if (isset($_POST["edit"])) {
    array_pop($_POST);
    extract($_POST);

    if (isset($author, $comment) && empty($author) && empty($comment)) {
        $error = "<p class='text-center bg bg-danger text-white'>Veuillez renseigner tous les champs, svp!</p>";
    } else if (($author === $post->author) || ($comment === $post->comment)) {
        $error = "Vous n'avez fait aucune modification.";
    } else {
        $request = $db->prepare("UPDATE comments SET author = :author, comment = :comment, valid = 1 
                                WHERE id = :id");
        $request->execute([
            "author" => $author,
            "comment" => $comment,
            "id" => $comment_id
        ]);

        set_flash("Le commentaire a été modéré avec succès!", "success");
        redirect_to("index.php");
    }
} else if (isset($_POST["reset"])) {
    $reset = $db->exec("DELETE FROM comments WHERE id = $comment_id");
    if ($reset) {
        set_flash("Le commentaire a été rejeter avec succès!", "success");
        redirect_to("/admin/index.php");
    }
}

// Entete du fichier
$title = "Edition du commentaire-" . $comment->id;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'comments.view.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 