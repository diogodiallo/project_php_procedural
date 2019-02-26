<div class="row">
    <ul class="pagination col-md-4 offset-md-4 mt-3">
        <?php for ($i = 1; $i <= $pageNumber; $i++): ?>
        <?php if ($i === $currentPage): ?>
        <li class="page-item">[
            <?= $i; ?>]</li>
        <?php else: ?>
        <li class="page-item">
            <a href="<?= $file; ?>?page=<?= $i; ?>" class="btn btn-primary page-link">
                <?= $i; ?></a>
        </li>
        <?php endif; ?>
        <?php endfor; ?>
    </ul>
</div>