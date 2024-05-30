<?php
/** @var ?string $pageTitle */

$pageTitle ??= 'Телефонный справочник';
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
            <h1>Телефонный справочник</h1>
        </a>
    </header>

    <main>