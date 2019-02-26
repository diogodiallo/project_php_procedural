<div class="container mt-4">
    <hr>
    <h1 class="text-center">Nous contacter</h1>
    <form action="" method="post" class="form-group col-md-8 offset-md-2 text-white bg-dark">
        <?php include 'partials/_errors.php'; ?>
        <fieldset>
            <legend class="small">
                Renseigner ce formulaire pour nous contacter
                (veuillez vérifier votre e-mail pour qu'on puisse vous répondre)
            </legend>
            <div class="row">
                <p class="col-md-6"><input type="text" name="last_name" id="last_name"
                        value="<?= isset($last_name) ? htmlentities(strtoupper($last_name)) : ''; ?>"
                        class="form-control" placeholder="Nom de famille"></p>
                <p class="col-md-6"><input type="text" name="first_name" id="first_name"
                        value="<?= isset($first_name) ? htmlentities($first_name) : ''; ?>" class="form-control"
                        placeholder="Prénom">
                </p>
            </div>
            <div class="row">
                <p class="col-md-6"><input type="text" name="email" id="email" class="form-control"
                        value="<?= isset($email) ? htmlentities($email) : ''; ?>" placeholder="Adresse E-mail">
                </p>
                <p class="col-md-6"><input type="text" name="object" id="object" class="form-control"
                        value="<?= isset($object) ? htmlentities($object) : ''; ?>" placeholder="Objet du message">
                </p>
            </div>
            <div class="row">
                <p class="col-md-4">
                    <select class="form-control" name="recipient" placeholder="Destinataire">
                        <option value="administrateur">Administrateur</option>
                        <option value="developpeur">Développeur</option>
                        <option value="secretaire" selected>Sécrétaire</option>
                    </select>
                </p>
                <p class="col-md-8">
                    <textarea name="message" rows="8" cols="80" class="form-control" placeholder="Votre message">
                        <?= isset($message) ? htmlspecialchars($message) : ''; ?>
                    </textarea>
                </p>
            </div>
            <input type="submit" name="contact" value="Envoyer" class="btn btn-outline-primary mb-4 btn-block">
        </fieldset>
    </form>
</div>