<?php

use Illuminate\Container\Container;
use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Repositories\ContactsRepository;
use App\Config;

function container(): Container
{
    return Container::getInstance();
}

container()->singleton(ContactsRepositoryContract::class, ContactsRepository::class);
container()->singleton(Config::class, function () {
    return (new Config(APP_DIR . DIRECTORY_SEPARATOR . 'config'))->load();
});
