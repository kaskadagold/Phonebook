<?php
/** @var ?array $messages */

if(!empty($messages ?? [])) { ?>
    <div class="success">
        <?php foreach ($messages as $message) { ?>
            <p class="flashMessage"><?= htmlspecialchars($message) ?></p>
        <?php } ?>
    </div>
<?php } ?>
