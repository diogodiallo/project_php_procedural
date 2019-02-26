<div class="row">
    <?php while ($post = $req->fetch(PDO::FETCH_OBJ)): ?>
    <div class="col-md-4 col-xs-12 col-sm-3 col-lg-4 d-flex flex-wrap">
        <div class="card">
            <div class="card-header bg-secondary text-white">
                <h2 class="card-title small"><a href="show.php?id=<?= $post->id; ?>" class="text-white">
                        <?= upper($post->title); ?></a></h2>
            </div>
            <div class="card-body">
                <p class="text-sm">
                    <em class="small">Posté le :
                        <time>
                            <?= date('d-m-Y H:i:s', strtotime($post->created_at)); ?></time>
                        <br><em>par :
                            <?= upper($post->username); ?></em>
                    </em>
                </p>
                <div class="card-text">
                    <?php if (isset($post->photos)): ?>
                    <img src="<?= isset($post->photos) ? 'uploads/' . $post->photos : 'uploads/default.jpeg'; ?>"
                        alt="<?= $post->photos; ?>" class="float-left mr-2" width="30%" height="30%">
                    <?php else: ?>
                    <img src="<?= $post->photos; ?>" alt="Default image" class="float-left mr-2" width="30%"
                        height="30%">
                    <?php endif; ?>
                    <?= substr($post->content, 0, 250); ?>...
                </div>
            </div>
            <a href="show.php?id=<?= $post->id; ?>" class="btn btn-success">Lire la suite</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>

<!-- Affichage de la pagination -->
<?php

include_once dirname(__DIR__, 1) . DIRECTORY_SEPARATOR . "partials" . DIRECTORY_SEPARATOR . "_show_pager.php";