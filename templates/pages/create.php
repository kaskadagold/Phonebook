<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Добавление контакта</title>
    <link rel="stylesheet" href="/assets/css/adding.css">
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
        <div class="titleBack">
            <h2>Добавление нового контакта</h2>
            
            <a href="/">
                <button>Вернуться к списку контактов</button>
            </a>
        </div>

        <form action="/create" method="post">
            <label for="contactName">Имя: </label>
            <input type="text" placeholder="Name" name="contactName" required>

            <label for="contactPhone">Телефон: </label>
            <input type="tel" placeholder="xxx-xxx-xx-xx" name="contactPhone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}" title="xxx-xxx-xx-xx" required>

            <input type="submit" name="addButton" value="Добавить">
        </form>
    </main>
</body>
</html>