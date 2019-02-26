<?php if (isset($_SESSION['notif']['type']) && isset($_SESSION['notif']['message'])): ?>
<div class="container">
    <div class="bg bg-<?= $_SESSION['notif']['type']; ?> text-center text-white">
        <?= $_SESSION['notif']['message']; ?>
    </div>
    <?php unset($_SESSION['notif']); ?>
</div>
<?php endif; ?>