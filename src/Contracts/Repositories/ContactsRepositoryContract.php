<?php

namespace App\Contracts\Repositories;

use App\Models\Contact;

interface ContactsRepositoryContract
{
    public function getContacts(): array;

    public function create(string $name, string $phone): void;

    public function delete(int $id): void;

    public function getById(int $id): ?Contact;

    public function update(int $id, string $name, string $phone): void;
}
