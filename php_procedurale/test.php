<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'authenticate.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'func' . DIRECTORY_SEPARATOR . 'utility.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'database.php';

$db = db();
$id = 1;
$user_infos = user_infos_completed($id);
$user_role = find_user_role($id);

$req = $db->prepare("INSERT INTO users(roles_id, ui_id, username, email, password, ip) 
                        VALUES(:roles_id, :ui_id, :username, :email, :password, :ip)
                    ");


if (isset($_POST["registration"])) {
    extract($_POST);
    array_pop($_POST);

    if (empty($username) || mb_strlen($username) < 3) {
        $error = "Votre nom d'utilisateur doit contenir au moins 3 caractères!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Entrez une adresse E-mail valide!";
    } elseif (mb_strlen($password) < 6) {
        $error = "Le mot de passe doit contenir au moins 6 caractères!";
    } elseif ($password !== $password_confirm) {
        $error = "Les mots de passe ne sont pas identiques!";
    } else {
        $password = password_hash($password, PASSWORD_BCRYPT, ["cost" => 12]);
        $ip = $_SERVER["REMOTE_ADDR"];

        $insert = $req->execute([
            "roles_id" => $user_role->id,
            "ui_id" => $user_infos->id,
            "username" => $username,
            "email" => mb_strtolower($email),
            "password" => $password,
            "ip" => $ip
        ]);

        if ($insert) {
            set_flash("Votre inscription a été prise en compte avec succès!", "success");
            redirect_to("/login.php");
        } else {
            set_flash("Une erreur inattendue est survenue lors de votre inscription!", "danger");
            redirect_to("/index.php");
        }
    }
}

?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <img src="<?= get_avatar_url($user->email); ?>" alt="profile de <?= $user->username; ?>">
        <h5 class="card-title lead">Profile de <?= ucfirst($user->username); ?>
        </h5>
    </div>
    <div class="card-body">
        <div class="card-text">
            <strong>Prenom :</strong><?= $user_infos->firstname ?? 'Non renseigne'; ?><br>

            <strong>Nom :</strong><?= $user_infos->lastname ?? ' Non renseigne '; ?><br>

            <strong>E-mail :</strong><?= strtolower($user->email); ?><br>
            <strong>Pseudo :</strong><?= ucfirst($user->username); ?><br>
            <strong>Accréditation : </strong><?= $user_role->name; ?><br>
            <strong>Genre : </strong><?= $user_infos->gender ?? 'Non fourni'; ?>
        </div>
    </div>
    <div class="card-footer">
        <strong>Biographie : </strong>
        <?= $user_infos->biography ?? ' Aucune biographie encore !'; ?><br>
    </div>
</div>
<?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'header.php'; ?>
<div class="card-body">
    <?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
    <form action="" method="POST" autocomplete="off">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="username" class="control-label">Votre username</label>
                <input type="text" name="username" id="username" required placeholder="jeandupond"
                    value="<?= $username ?? ''; ?>" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="email" class="control-label">Votre email</label>
                <input type="email" name="email" id="email" required placeholder="jean.dupond@gmail.com"
                    value="<?= $email ?? ''; ?>" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label for="password" class="control-label">Votre password</label>
                <input type="password" name="password" id="password" required class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="password_confirm" class="control-label">Confirmer votre password</label>
                <input type="password" name="password_confirm" id="password_confirm" required class="form-control">
            </div>
        </div>
        <button type="submit" name="registration" class="btn btn-outline-default btn-block">Envoyer</button>
    </form>
</div>