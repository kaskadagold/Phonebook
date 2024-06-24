<?php

use App\Repositories\ContactsRepositoryDatabase;
use Illuminate\Container\Container;
use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Repositories\ContactsRepositoryJSON;
use App\FlashMessages;
use App\Config;
use Dotenv\Dotenv;
use App\Database;
use Symfony\Component\HttpFoundation\Session\Session;

function container(): Container
{
    return Container::getInstance();
}

function config(): Config
{
    return container()->get(Config::class);
}

function database(): Database
{
    return container()->get(Database::class);
}

$dotenv = Dotenv::createImmutable(APP_DIR);
$dotenv->load();

container()->singleton(Config::class, function () {
    return (new Config(APP_DIR . DIRECTORY_SEPARATOR . 'config'))->load();
});

/** 
 * Choose a suitable repository implementation to store data
 */
if (config()->get('storage')['type'] === 'json') {
    container()->singleton(ContactsRepositoryContract::class, ContactsRepositoryJSON::class);
} elseif (config()->get('storage')['type'] === 'database') {
    container()->singleton(ContactsRepositoryContract::class, ContactsRepositoryDatabase::class);
}

container()->singleton(Session::class, function () {
    $session = new Session();
    $session->start();
    return $session;
});

function flash(): FlashMessages
{
    return container()->get(FlashMessages::class);
}
