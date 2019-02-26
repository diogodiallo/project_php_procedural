<div class="container">
    <h1 class="text-center">Editer ce commentaire</h1>
    <?= isset($error) ? $error : ''; ?>
    <form action="" method="post" class="col-md-8 offset-md-2 text-white bg-dark">
        <fieldset>
            <legend>Edition du commentaire de
                <?= upper($comment->author); ?>
            </legend>
            <p class="form-group">
                <label for="author" class="control-label">Auteur(*) </label>
                <input type="text" name="author" id="author"
                    value="<?= isset($comment->author) ? ($comment->author) : ''; ?>" class="form-control">
            </p>
            <p class="form-group">
                <label for="comment" class="control-label">Contenu commentaire(*) </label>
                <textarea name="comment" id="comment" rows="8" cols="80" class="form-control">
                    <?= isset($comment->comment) ? ($comment->comment) : ''; ?>
                </textarea>
            </p>
            <input type="submit" name="edit" value="Modérer" class="btn btn-primary mb-4">
            <input type="submit" name="reset" value="Rejeter" class="btn btn-danger mb-4">
        </fieldset>
    </form>
</div>
<div class="row">
    <div class="col-md-6 offset-md-3 mt-4">
        <a href="index.php" class="btn btn-outline-success"><i class="fas fa-angle-double-left"></i> Retour a l'espace
            admin</a>
    </div>
</div>