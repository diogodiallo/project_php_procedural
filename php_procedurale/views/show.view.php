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
                            <img src="<?= 'uploads/' . $post->photos; ?>" alt="<?= $post->photos; ?>" width="98%"
                                class="rounded">
                        </p>
                        <div class="col-md-8">
                            <?= $post->content; ?>
                        </div>
                    </div>
                </div>
                <p class="text-center">
                    <a href="comment.php?id=<?= $post->id; ?>" class="btn btn-primary">
                        Commenter cet article
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>