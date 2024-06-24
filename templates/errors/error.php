<?php
/** 
 * @var string $message
 * @var int $code
 */

use App\View;

View::includeTemplate('layouts/header.php', [
    'pageTitle' => 'Телефонный справочник - Возникла ошибка',
    'headerTitle' => $code . ' - Возникла ошибка',
]);
?>

<p><?= htmlspecialchars($message) ?></p>

<?php
View::includeTemplate('layouts/footer.php');
