<div class="container">
    <h1 class="text-center">Editer cet article</h1>
    <?php require_once dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>
    <form action="" method="post" class="col-md-8 offset-md-2 text-white bg-dark">
        <fieldset>
            <legend>Edition de
                <?= upper($post->title); ?>
            </legend>
            <p class="form-group">
                <label for="title" class="control-label">Titre article(*) </label>
                <input type="text" name="title" id="title" value="<?= isset($post->title) ? ($post->title) : ''; ?>"
                    class="form-control">
            </p>
            <p class="form-group">
                <label for="content" class="control-label">Contenu article(*) </label>
                <textarea name="content" id="content" rows="8" cols="80" class="form-control">
          <?= isset($post->content) ? ($post->content) : ''; ?>
        </textarea>
            </p>
            <p class="form-group">
                <label for="file" class="control-lable">Ajouter un fichier</label>
                <input type="file" name="file" id="file" value="<?= isset($post->photos) ? ($post->photos) : ''; ?>"
                    class="form-control">
            </p>
            <input type="submit" name="edit" value="Editer" class="btn btn-primary mb-4">
        </fieldset>
    </form>
</div>

<div class="row">
    <div class="col-md-6 offset-md-3 mt-4">
        <a href="index.php" class="btn btn-outline-success">
            <i class="fas fa-angle-double-left"></i> Retour a l'espace admin
        </a>
    </div>
</div>