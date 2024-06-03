<?php
/** @var ?string $pageTitle */

$pageTitle ??= 'Телефонный справочник';
$headerTitle ??= 'Телефонный справочник';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/adding.css">
    <link rel="stylesheet" href="/assets/css/header.css">
    <link rel="stylesheet" href="/assets/css/buttons.css">
</head>

<body>
    <header>
        <a href="/">
            <h1><?= htmlspecialchars($headerTitle) ?></h1>
        </a>
    </header>

    <main>
        <?php 
        \App\View::includeTemplate('blocks/messages/error_message.php', ['messages' => flash()->getErrors()]);
        \App\View::includeTemplate('blocks/messages/success_message.php', ['messages' => flash()->getSuccesses()]);
