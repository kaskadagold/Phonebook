<?php
/** @var ?array $messages */

if(!empty($messages ?? [])) { ?>
    <div class="error">
        <?php foreach ($messages as $message) { ?>
            <p class="flashMessage"><?= htmlspecialchars($message) ?></p>
        <?php } ?>
    </div>
<?php } ?>
