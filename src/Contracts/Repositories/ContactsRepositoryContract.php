<?php

namespace App\Contracts\Repositories;

interface ContactsRepositoryContract
{
    public function getContacts(): array;

    public function create(string $name, string $phone): void;

    public function delete(int $id): void;
}
