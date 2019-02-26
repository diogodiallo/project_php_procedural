<div class="container">
    <?php require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
    <h1 class="text-center">Ajouter un article</h1>
    <form action="" method="post" class="col-md-8 offset-md-2 text-white bg-dark" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter</legend>
            <p class="form-group">
                <label for="title" class="control-label">Titre article(*) </label>
                <input type="text" name="title" id="title" class="form-control">
            </p>
            <p class="form-group">
                <label for="content" class="control-label">Contenu article(*) </label>
                <textarea name="content" id="content" rows="8" cols="80" class="form-control"></textarea>
            </p>
            <p class="form-group">
                <label for="file" class="control-lable">Ajouter un fichier</label>
                <input type="file" name="photos" id="file" class="form-control">
            </p>
            <input type="submit" name="add" value="Ajouter" class="btn btn-primary mb-4">
        </fieldset>
    </form>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3 mt-4">
        <a href="index.php" class="btn btn-outline-success"><i class="fas fa-angle-double-left"></i> Retour a l'espace
            admin</a>
    </div>
</div>