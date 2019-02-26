<?php if (isset($error) && !empty($error)): ?>
<div class="mt-2">
    <div class="bg bg-danger text-center text-white">
        <?= $error; ?>
    </div>
</div>
<?php endif; ?>