<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
            aria-selected="true">Mes informations</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
            aria-selected="false">Paramètres</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
            aria-selected="false">Contact</a>
    </li>
</ul>

<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <img src="<?= get_avatar_url($user->email); ?>" alt="profile de <?= $user->username; ?>">
                        <h5 class="card-title lead">Profile de
                            <?= ucfirst($user->username); ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="card-text">
                            <strong>Prenom :</strong>
                            <?= $user_infos->firstname ?? 'Non renseigne'; ?><br>

                            <strong>Nom :</strong>
                            <?= $user_infos->lastname ?? ' Non renseigne '; ?><br>

                            <strong>E-mail :</strong>
                            <?= strtolower($user->email); ?><br>
                            <strong>Pseudo :</strong>
                            <?= ucfirst($user->username); ?><br>
                            <strong>Accréditation : </strong>
                            <?= $user_role->name ?? 'Membre'; ?><br>
                            <strong>Genre : </strong>
                            <?= $user_infos->gender ?? 'Non fourni'; ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <strong>Biographie : </strong>
                        <?= $user_infos->biography ?? ' Aucune biographie encore !'; ?><br>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-white bg-primary">
                        <h3 class="card-title lead text-center">
                            Completer vos informations si vous le souhaiter
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="mt-2">
                            <?php require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <input type="text" name="lastname" value="<?= $lastname ?? ''; ?>"
                                        placeholder="Votre nom" class="form-control">

                                    <input type="text" name="firstname" value="<?= $firstname ?? ''; ?>"
                                        placeholder="Votre prénom" class="form-control">

                                    <input type="radio" name="gender" value="Homme" checked> Homme
                                    <input type="radio" name="gender" value="Femme"> Femme

                                </div>
                                <div class="form-group col-md-7">
                                    <textarea name="biography" rows="5" placeholder="Une petite description de vous"
                                        class="form-control">
                                        <?= $biography ?? ''; ?>
                                    </textarea>
                                    <input type="submit" name="complete" value="Compléter votre profile"
                                        class="btn btn-success btn-block mt-1">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <h5 class="small">Complété mon profile</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <h5 class="text-center">Modifier mon pseudonyme</h5>
        <form action="" method="post" class="form-inline">
            <input type="text" name="username" value="<?= $user->username; ?>" placeholder="Modifier mon pseudo"
                class="form-control">
            <button type="submit" name="pseudo" class="btn btn-outline-success ml-4">Changer mon pseudo</button>
            <?= isset($pseudo_error) ? '<div class="btn btn-danger" >' . $pseudo_error . '</div>' : ''; ?>
        </form>
        <hr>

        <h5 class="text-center">Modifier mon mot de passe</h5>
        <form action="" method="post" class="form-inline">
            <input type="password" name="old_password" placeholder="Ancien mot de passe" class="form-control">
            <input type="password" name="password" placeholder="Nouveau mot de passe" class="form-control">
            <button type="submit" name="pass" class="btn btn-outline-primary ml-4">Changer mot de passe</button><br>
            <?= isset($password_error) ? '<div class="btn btn-danger" >' . $password_error . '</div>' : ''; ?>
        </form>
        <hr>

        <h5 class="text-center">Supprimer mon compte</h5>
        <form action="" method="POST">
            <button name="delete_user_count" class="btn btn-outline-danger"
                onclick="return confirm('Etes-vous certain de vouloir supprimer votre profil ?')">Supprimer mon
                compte</button>
        </form>
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <p>Téléphone : 00-11-23-99-07</p>
        <p>Adresse E-mail :
            <?= mb_strtolower($user->email); ?>
        </p>
        <p>Adresse postale : 24/33 Rue de la Justice 59000 LILLE</p>
    </div>
</div>