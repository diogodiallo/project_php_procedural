<fieldset class="row">
    <div class="card col-md-6 offset-md-3 border-default">
        <div class="card-header bg-default">
            <h5 class="card-title">Inscrivez-vous</h5>
        </div>
        <div class="card-body">
            <?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
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
                        <input type="password" name="password_confirm" id="password_confirm" required
                            class="form-control">
                    </div>
                </div>
                <button type="submit" name="registration" class="btn btn-outline-default btn-block">Envoyer</button>
            </form>
        </div>
    </div>
</fieldset>