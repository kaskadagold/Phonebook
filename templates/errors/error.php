<?php
/** 
 * @var int $code
 * @var string $message
 */

use App\View;

View::includeTemplate('layout/header.php', [
    'pageTitle' => 'Телефонный справочник - Возникла ошибка',
    'headerTitle' => $code . ' - Возникла ошибка',
]);
?>

<p><?= htmlspecialchars($message) ?></p>

<?php
View::includeTemplate('layout/footer.php');
