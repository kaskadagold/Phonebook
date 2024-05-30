<?php
use App\View;

View::includeTemplate('layouts/header.php', ['pageTitle' => 'Добавление контакта']);
?>

<div class="titleBack">
    <h2>Добавление нового контакта</h2>
    
    <a href="/">
        <button>Вернуться к списку контактов</button>
    </a>
</div>

<div class="creationForm">
    <form action="/create" method="post">
        <?php View::includeTemplate('blocks/contact_form_fields.php') ?>

        <input type="submit" name="addButton" value="Добавить">
    </form>
</div>

<?php
View::includeTemplate('layouts/footer.php');
