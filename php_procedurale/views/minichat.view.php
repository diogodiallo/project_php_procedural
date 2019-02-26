<div class="row">
    <div class="container col-md-6 offset-md-3">
        <h1 class="text-center">Mini-chat</h1>
        <!-- Recuperation des informations saisies par l'utilisateur et affichage d'eventuelles erreurs -->
        <?php if ($select->rowCount() > 0): ?>
        <!-- Debut affichage des infos du minichat -->
        <?php while ($data = $select->fetch(PDO::FETCH_OBJ)): ?>

        <div class="bg-secondary text-white p-1">
            [
            <?= $data->chat_date; ?>]
            <strong>
                <?= htmlspecialchars(strtoupper($data->pseudo)); ?>
            </strong> :
            <?= htmlspecialchars(nl2br($data->message)); ?>
        </div>
        <?php endwhile; ?>
        <?php else: $select->closeCursor(); ?>
        <p class='bg bg-info text-white text-center'>Il n'ya aucun message dans le chat pour le moment!</p>"
        <?php endif; ?>


        <?php include_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
        <hr>
        <!-- Formulaire du chat -->
        <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline">

            <div class="form-group">
                <input type="text" name="pseudo" value="<?= isset($_POST['pseudo']) ? $_POST['pseudo'] : ''; ?>"
                    class="form-control" placeholder="Pseudo">

                <input type="text" name="message" value="<?= isset($_POST['message']) ? $_POST['message'] : ''; ?>"
                    class="form-control" placeholder="Votre message">
            </div>
            <button type="submit" name="chat" class="btn btn-primary ml-2">Chatter</button>
            <button name="refresh" class="btn btn-success btn-sm pr-0" title="Raraichir la page">Refresh</button>
        </form>
    </div>
</div>

<!-- Affichage de la pagination -->
<?php
include_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "_show_pager.php";