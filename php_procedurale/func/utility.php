<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!file_exists('set_flash')) {
    function set_flash(string $message, string $type = 'info'): void
    {
        $_SESSION['notif']['type'] = $type;
        $_SESSION['notif']['message'] = $message;
    }
}

function redirect_to($file): void
{
    header("Location:" . $file);
    exit();
}

function dump($var)
{
    var_dump($var);
    exit();
}

function set_active(string $path): string
{
    $page = array_pop(explode(DIRECTORY_SEPARATOR, $_SERVER["SCRIPT_NAME"]));

    if ($page === $path . ".php") {
        return 'active';
    }

    return "";
}

if (!file_exists('upper')) {
    function upper($value)
    {
        return mb_strtoupper($value);
    }
}


function get_session($key)
{
    if ($key) {
        return !empty($_SESSION['connected'][$key]) ? $_SESSION['connected'][$key] : null;
    }
}


/**
 * @param $field, $table. default table users
 * @return object $data
 */
function find_user($field, $table = "users"): object
{
    global $db;
    $q = $db->query("SELECT $field FROM $table");
    $data = $q->fetch(PDO::FETCH_OBJ);

    return $data;
}

function find_user_by_id($id)
{
    global $db;

    $req = $db->prepare("SELECT u.id, ui_id, username, email, password, firstname, lastname, gender, biography 
                        FROM users u
                        LEFT JOIN user_infos ui
                            ON ui_id = u.id
                        WHERE u.id = ?
                    ");

    $req->execute([
        $id
    ]);

    $data = $req->fetch(PDO::FETCH_OBJ);

    return $data;
}


function find_user_role($id)
{

    global $db;
    $sql = $db->prepare("SELECT id, level, name
                    FROM roles
                    WHERE id = :id
                    ");
    $sql->execute(["id" => $id]);

    $data = $sql->fetch(PDO::FETCH_OBJ);

    return $data;
}

function user_infos_completed($id)
{

    global $db;
    $req = $db->prepare("SELECT id, firstname, lastname, gender, biography
                    FROM user_infos
                    WHERE id = :id
                    ");
    $req->execute(["id" => $id]);
    $data = $req->fetch(PDO::FETCH_OBJ);

    return $data;
}

function user_infos_updeted($id, $lastname, $firstname, $gender, $biography)
{
    global $db;
    $req = $db->prepare("UPDATE user_infos SET lastname = :lastname, firstname = :firstname, 
                                gender = :gender, biography = :biography
                            WHERE id = :id
                        ");
    $req->execute([
        "lastname" => $lastname,
        "firstname" => $firstname,
        "gender" => $gender,
        "biography" => $biography,
        "id" => $id
    ]);
    $data = $req->fetch(PDO::FETCH_OBJ);

    return $data;
}



function get_avatar_url($email, $size = 30)
{
    return "https://www.gravatar.com/avatar/" . md5(mb_strtolower(trim($email))) . "?s=" . $size;
}