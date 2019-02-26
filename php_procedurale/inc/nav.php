<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand <?= set_active('/index'); ?>" href="/index.php">PHP MVC</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02"
        aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?= set_active('blog'); ?>">
                <a class="nav-link" href="/blog.php">Blog</a>
            </li>

            <li class="nav-item <?= set_active('login'); ?>">
                <a class="nav-link" href="/login.php">Connexion</a>
            </li>
            <li class="nav-item <?= set_active('register'); ?>">
                <a class="nav-link" href="/register.php">Inscription</a>
            </li>

            <li class="nav-item <?= set_active('contact'); ?>">
                <a class="nav-link" href="/contact.php">Contact</a>
            </li>

        </ul>
        <?php if (is_connected()): ?>
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a href="/profile.php" class="nav-link">Mon profile</a>
            </li>
            <li class="nav-item">
                <a href="/minichat.php" class="nav-link">Chattez</a>
            </li>
            <?php if ($_SESSION['connected']['level'] > 1): ?>
            <li class="nav-item">
                <a href="/admin/index.php" class="nav-link">Espace admin</a>
            </li>
            <?php endif; ?>
            <li class="nav-item">
                <a href="/logout.php" class="nav-link">Déconnexion</a>
            </li>
        </ul>
        <?php endif; ?>

        <form class="form-inline my-2 my-md-0">
            <input class="form-control" type="text" placeholder="Search">
        </form>
    </div>
</nav>
<?php include_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . '_flash.php'; ?>