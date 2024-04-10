<?php
include ("functions.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Добавление контакта</title>
    <link rel="stylesheet" href="styles/adding.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/buttons.css">
</head>

<body>
    <header>
        <a href="index.php">
            <h1>Телефонный справочник</h1>
        </a>
    </header>

    <main>
        <div class="titleBack">
            <h2>Добавление нового контакта</h2>
            
            <a href="index.php">
                <button>Вернуться к списку контактов</button>
            </a>
        </div>

        <form action="" method="get">
            <label for="contactName">Имя: </label>
            <input type="text" placeholder="Name" name="contactName">
            <label for="contactPhone">Телефон: </label>
            <input type="tel" placeholder="+7-9xx-xxx-xx-xx" name="contactPhone">
            <input type="submit" name="addButton" value="Добавить">
        </form>
    </main>
</body>
</html>