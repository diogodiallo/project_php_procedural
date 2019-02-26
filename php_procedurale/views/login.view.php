<fieldset class="row mt-5">
    <div class="card col-md-6 offset-md-3 border-primary">
        <div class="card-header bg-success text-white">
            <h5 class="card-title">Connectez-vous</h5>
        </div>
        <?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
        <div class="card-body">
            <form action="" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="identifiant" class="control-label">Votre identifiant</label>
                    <input type="text" name="identifiant" id="identifiant"
                        placeholder="jeandupond ou jean.dupond@gmail.com" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Votre password</label>
                    <input type="password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" name="connection" class="btn btn-outline-success btn-block">Envoyer</button>
                <p class="text-center mr-3">
                    <a href="/forget.php" class="small">Mot de passe oublié?</a>
                    <a href="/register.php" class="small">Inscrivez-vous</a>
                </p>
            </form>
        </div>
    </div>
</fieldset>