<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Телефонный справочник</title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/buttons.css">
</head>

<body>
    <header>
        <a href="/">
            <h1>Телефонный справочник</h1>
        </a>
    </header>

    <main>
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
                        <th class="nameField">Имя</th>
                        <th class="phoneField">Телефон</th>
                    <tr>

                    <?php 
                    $baseUrlForDelete = "/delete";
                    foreach ($contactsList as $contact) {
                        $currentUrlForDelete = $baseUrlForDelete . '/' . $contact->id;
                    ?>
                        <tr>
                            <td class="deleteButton">
                                <form action="<?= $currentUrlForDelete ?>" method="post">
                                    <button class="imageButton">
                                        <img src="/assets/images/recycle-bin.png" alt="Удалить" title="Удалить">
                                    </button>
                                </form>
                            </td>
                            <td class="nameField"><?= $contact->name ?></td>
                            <td class="phoneField"><?= $contact->phone ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </main>
</body>
</html>
