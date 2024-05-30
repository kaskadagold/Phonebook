<?php
use App\View;

View::includeTemplate('layouts/header.php', ['pageTitle' => 'Редактирование контакта']);
?>

<div class="titleBack">
    <h2>Редактирование контакта</h2>
    
    <a href="/">
        <button>Вернуться к списку контактов</button>
    </a>
</div>

<div class="creationForm">
    <form action="/update/<?= $contact->id ?>" method="post">
        <?php View::includeTemplate('blocks/contact_form_fields.php', ['contactName' => $contact->name, 'contactPhone' => $contact->phone]) ?>

        <input type="submit" name="updateButton" value="Обновить">
    </form>
</div>

<?php
View::includeTemplate('layouts/footer.php');
