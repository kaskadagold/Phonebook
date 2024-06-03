<?php

use Illuminate\Container\Container;
use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Repositories\ContactsRepositoryJSON;
use App\FlashMessages;

function container(): Container
{
    return Container::getInstance();
}

container()->singleton(ContactsRepositoryContract::class, ContactsRepositoryJSON::class);

function flash(): FlashMessages
{
    return container()->get(FlashMessages::class);
}
