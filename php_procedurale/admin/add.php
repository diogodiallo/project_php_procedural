<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$db = db();

//$find_user = find_user('id');

if (isset($_POST["add"])) {
    
    array_pop($_POST);
    extract($_POST);

    if (isset($title, $content) && empty($title) && empty($content)) {
        $error = "Veuillez renseigner tous les champs, svp!";
    } else {
        $file = $_FILES['photos'];
        $file_name = $file['name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_tmp = $file['tmp_name'];
        $file_name_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $autorized_extensions = ['jpeg', 'jpg', 'png', 'pdf'];

        if ($file_size <= 6000289) {
            if (in_array($file_name_extension, $autorized_extensions)) {
                $final_name = rand(1, 10) . '-' . basename($file_name);

                if (move_uploaded_file($file_tmp, '../uploads/' . $final_name)) {
                    $req = $db->prepare("INSERT INTO news(user_id, title, content, photos) 
                                            VALUES(:user_id, :title, :content, :photos)");
                    $insertComment = $req->execute([
                        "user_id"   => get_session('id'),
                        "title" => $title,
                        "content" => $content,
                        "photos" => $final_name
                    ]);
                    set_flash("Votre article a été ajouté avec succès!", "success");
                    redirect_to("index.php");
                }
            }
        }
    }
}
/**
 * Entete du fichier
 */
$title = "Ajouter un article";
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php';
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'nav.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'add.view.php';

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'footer.php';
 