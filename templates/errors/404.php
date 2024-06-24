<?php

use App\View;

View::includeTemplate('layouts\header.php', [
    'headerTitle' => '404 - Страница не найдена',
    'pageTitle' => 'Телефонный справочник - Страница не найдена'
]);
?>

<p>Запрошенная Вами страница не существует</p>

<?php
View::includeTemplate('layouts/footer.php');
