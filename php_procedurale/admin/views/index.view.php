<div class="container mt-5">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                aria-controls="nav-home" aria-selected="true">Articles</a>
            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                aria-controls="nav-profile" aria-selected="false">Commentaires</a>
            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab"
                aria-controls="nav-contact" aria-selected="false">Message des contacts</a>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            <h1>Liste des articles</h1>
            <p><a href="add.php" class="btn btn-primary float-right mb-3"><i class="fas fa-plus-circle"></i> Ajouter un
                    article</a></p>
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th colspan="2">Action</th>
                    </tr>

                    <?php while ($post = $req->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td>
                            <?= $post->id; ?>
                        </td>
                        <td>
                            <?= $post->title; ?>
                        </td>
                        <td>
                            <?= $post->content; ?>
                        </td>
                        <td>
                            <a href="edit.php?edit=<?= $post->id; ?>" class="btn btn-info"><i class="fas fa-eye-slash"
                                    title="Modifier"></i></a>
                        </td>
                        <td>
                            <?php if ($_SESSION['connected']['level'] > 2): ?>
                            <a href="?delete=<?= $post->id; ?>" class="btn btn-danger"
                                onclick="return confirm('Voulez-vous supprimer cet article?')">
                                <i class="fas fa-trash-restore" title="Supprimer"></i>
                            </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
            <h1>Liste des commentaires</h1>
            <div class="table-responsive">
                <table class="table table-responsive table-striped table-condensed">
                    <tr>
                        <th>ID</th>
                        <th>Auteur</th>
                        <th>Commentaires</th>
                        <th colspan="2">Actions</th>
                        <th>Modération</th>
                    </tr>

                    <?php while ($comment = $query->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td>
                            <?= $comment->id; ?>
                        </td>
                        <td>
                            <?= $comment->author; ?>
                        </td>
                        <td>
                            <?= $comment->comment; ?>
                        </td>
                        <td>
                            <a href="comments.php?comment=<?= $comment->id; ?>" class="btn btn-info"><i
                                    class="fas fa-eye-slash" title="Modifier"></i></a>
                        </td>
                        <td>
                            <a href="?del_com=<?= $comment->id; ?>" class="btn btn-danger"
                                onclick="return confirm('Voulez-vous supprimer ce commentaire?')">
                                <i class="fas fa-trash-restore" title="Supprimer"></i>
                            </a>
                        </td>
                        <td class="float-right">
                            <?= ($comment->valid == 1)
                                ? "<button class='btn btn-success'>Validé</button>"
                                : "<button class='btn btn-warning'>En attente</button>";
                            ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <tr>
                        <th>ID</th>
                        <th>Expéditeur</th>
                        <th>Nom complet</th>
                        <th>Objet</th>
                        <th>Destinataire</th>
                        <th>Message</th>
                    </tr>

                    <?php while ($contact = $sql->fetch(PDO::FETCH_OBJ)): ?>
                    <tr>
                        <td>
                            <?= $contact->id; ?>
                        </td>
                        <td>
                            <a href="mailto:<?= $contact->email; ?>">
                                <?= $contact->email; ?>
                            </a>
                        </td>
                        <td>
                            <?= $contact->firstname; ?>
                            <strong>
                                <?= mb_strtoupper($contact->lastname); ?></strong>
                        </td>
                        <td>
                            <?= $contact->object; ?>
                        </td>
                        <td>
                            <?= $contact->recipient; ?>
                        </td>
                        <td>
                            <?= nl2br($contact->message); ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>

                </table>
            </div>
        </div>
    </div>

</div>