<!-- Affichage de l'article -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title">
                    <?= $post->title; ?> |
                    <em class="small">
                        Posté le : <time>
                            <?= $post->post_date; ?></time> - par :
                        <?= upper($post->username); ?>
                    </em>
                </h5>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <div class="row">
                        <p class="col-md-4">
                            <?php if ($post->photos): ?>
                            <img src="<?= 'uploads/' . $post->photos; ?>" alt="<?= $post->photos; ?>" width="98%"
                                class="rounded">
                            <?php else: ?>
                            <img src="https://via.placeholder.com/300/300" alt="" class="rounded">
                            <?php endif; ?>
                        </p>
                        <div class="col-md-8">
                            <?= $post->content; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<!-- Affichage des commentaires -->
<?php if ($count > 0): ?>
<h4 class="text-center">(
    <?= ($count > 1) ? $count . ' Commentaires' : $count . ' Commentaire'; ?>)</h4>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <div class="card">
            <?php while ($comment = $query->fetch(PDO::FETCH_OBJ)): ?>
            <hr>
            <div class="card-header bg-secondary text-white">
                <h3 class="card-title">
                    <?= $comment->author; ?> à dit le :
                    <time class="small lead"><em>
                            <?= $comment->comment_date; ?></em></time>
                </h3>
            </div>
            <div class="card-body">
                <div class="card-text">
                    <?= $comment->comment; ?>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>
<?php else: ?>
<p class="text-center bg bg-info text-white">Cet article n'est pas encore commenté.</p>
<?php endif; ?>

<p class="text-center mt-3">
    <a href="/blog.php" class="btn btn-info"><i class="fas fa-angle-double-left"></i> Revenir aux news</a>
</p>

<!-- Ajout des commentaires -->
<h1 class="text-center lead">Ajouter un commentaire</h1>
<div class="container">
    <?php require_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_errors.php'; ?>

    <form action="" method="post" class="col-md-8 offset-md-2 text-white bg-dark">
        <fieldset>
            <legend class="small">Vous voulez commenter cet article?</legend>
            <div class="row">
                <p class="col-md-4"><input type="text" name="author" id="author" placeholder="Votre nom(*)"
                        class="form-control"></p>

                <p class="col-md-8">
                    <textarea name="message" rows="8" cols="" placeholder="Votre commentaire(*)"
                        class="form-control"></textarea>
                    <input type="submit" name="comment" value="Commenter"
                        class="btn btn-outline-primary btn-block mt-3">
                </p>
            </div>
        </fieldset>
    </form>
</div>