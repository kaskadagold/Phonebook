<?php
/** @var array $contactsList */

use App\View;

View::includeTemplate('layouts/header.php');
?>

<div class="addingButton">
    <a href="/create">
        <button>+ Добавить новый контакт </button>
    </a>
</div>

<div class="table">
    <h3>Список контактов</h3>

    <?php if (empty($contactsList)) {?>
        <p>Нет сохраненных контактов...</p>
    <?php } else { ?>
        <table>
            <tr>
                <th class="deleteButton"></th>
                <th class="updateButton"></th>
                <th class="nameField">Имя</th>
                <th class="phoneField">Телефон</th>
            <tr>

            <?php foreach ($contactsList as $contact) { ?>
                <tr>
                    <td class="deleteButton">
                        <form action="/delete/<?= $contact->id ?>" method="post">
                            <button class="imageButton">
                                <img src="/assets/images/recycle-bin.png" alt="Удалить" title="Удалить">
                            </button>
                        </form>
                    </td>
                    <td>
                        <a href="/update/<?= $contact->id ?>">
                            <button class="imageButton">
                                <img src="/assets/images/update-icon.png" alt="Редактировать" title="Редактировать">
                            </button>
                        </a>
                    </td>
                    <td class="nameField"><?= $contact->name ?></td>
                    <td class="phoneField"><?= $contact->phone ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
</div>

<?php
View::includeTemplate('layouts/footer.php');
