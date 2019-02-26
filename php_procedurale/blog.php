<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
/**
 * Recuperation des informations du blog et des variables pour la pagination (table et fichier)
 */
$db = db();
$file = "blog.php";
$table = "news";

include_once __DIR__ . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "_pagination.php";

$sql = "SELECT n.id, user_id, username, title, content, photos, n.created_at
        FROM news AS n
        LEFT JOIN users AS u
          ON u.id = user_id
        ORDER BY n.created_at DESC
        LIMIT $offset, $numberElementsByPage
      ";

$req = $db->query($sql);
//$posts = $req->fetch(PDO::FETCH_OBJ);


/**
 * Entete du fichier
 */
$title = "Blog";
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'blog.view.php';

?>

<?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php'; ?>