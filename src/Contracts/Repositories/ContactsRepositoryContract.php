<?php

namespace App\Contracts\Repositories;

use App\Models\Contact;

interface ContactsRepositoryContract
{
    public function getContacts(): array;

    public function create(string $name, string $phone): bool;

    public function delete(int $id): bool;

    public function getById(int $id): ?Contact;

    public function update(int $id, string $name, string $phone): bool;
}
