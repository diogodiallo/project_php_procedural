<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$id = (int)$_GET["id"];

$insultes = ["cul", "salop", "salope", "salopard", "con", "connard", "merde", "conar", "pute", "putes", "petasse", "petasses", "batard"];
$replace_character = [];
foreach ($insultes as $insulte) {
    $replace_character[] = mb_substr($insulte, 0, 1) . str_repeat("*", mb_strlen($insulte) - 1);
}

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

// Recuperations des commentaires lies a l'article en cours
$query = $db->prepare("SELECT id, news_id, author, comment, valid,
                        DATE_FORMAT(comments.created_at, '%d-%m-%Y %Hh%imn%ss') AS comment_date
                        FROM comments
                        WHERE news_id=?
                        AND valid = 1
                        ORDER BY comment_date DESC
                    ");
$query->execute([$id]);

// On compte le nombre des commentaires lies a un article
$count = $db->query("SELECT news_id, COUNT(*)
                    FROM news
                    LEFT JOIN comments
                    ON news.id = news_id
                    WHERE news_id = $id
                    GROUP BY comments.id
                    ")->rowCount();

// Insertion des Commentaires
if (isset($_POST["comment"])) {
    extract($_POST);
    array_pop($_POST);



    if (empty($author) && empty($message)) {
        $error = "Veuillez renseigner tous les champs, svp!";
    } else {
        $req = $db->prepare("INSERT INTO comments(news_id, author, comment) 
                            VALUES(:news_id, :author, :comment)");

        /** Filtre des insultes en gardant le premier caractere */
        $message = str_replace($insultes, $replace_character, $message);

        $insertComment = $req->execute([
            "news_id" => $id,
            "author" => $author,
            "comment" => $message
        ]);

        if ($insertComment) {
            set_flash("Votre commentaire a été ajouté avec succès.", "success");
            redirect_to("index.php");
        }
    }
}
/**
 * Entete du fichier
 */
$title = $post->title;
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'comment.view.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 