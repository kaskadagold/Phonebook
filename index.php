<?php
require_once "functions.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Телефонный справочник</title>
    <link rel="stylesheet" href="styles/main.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/buttons.css">
</head>

<body>
    <header>
        <a href="index.html">
            <h1>Телефонный справочник</h1>
        </a>
    </header>

    <main>
        <div class="addingButton">
            <a href="adding.php">
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
                        <th></th>
                        <th class="nameField">Имя</th>
                        <th class="phoneField">Телефон</th>
                    <tr>

                    <?php 
                    $baseUrlForDelete = "deleting.php";
                    foreach ($contactsList as $id => $contact) {
                        $currentUrlForDelete = $baseUrlForDelete . "?id={$id}";
                    ?>
                        <tr>
                            <td class="deleteButton">
                                <a href=<?php echo $currentUrlForDelete; ?>>
                                    <button class="imageButton">
                                        <img src="styles/recycle-bin.png" alt="Удалить" title="Удалить">
                                    </button>
                                </a>
                            </td>
                            <td class="nameField"><?php echo($contact["name"]) ?></td>
                            <td class="phoneField"><?php echo($contact["phone"]) ?></td>
                        </tr>
                    <?php } ?>
                </table>
            <?php } ?>
        </div>
    </main>
</body>
</html>
