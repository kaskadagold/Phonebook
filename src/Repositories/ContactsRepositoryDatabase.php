<?php

namespace App\Repositories;

use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Models\Contact;

class ContactsRepositoryDatabase implements ContactsRepositoryContract
{
    
    public function getContacts(): array
    {
        $connection = database()->connect();

        $query = $connection->prepare(
            'SELECT *
            FROM `contacts`'
        );
        $query->execute();

        $result = [];
        while ($temp = $query->fetch(\PDO::FETCH_ASSOC)) {
            $contact = new Contact($temp['name'], $temp['phone'], $temp['id']);
            $result[] = $contact;
        }

        return $result;
    }

    public function create(string $name, string $phone): void
    {
        $connection = database()->connect();

        $query = $connection->prepare(
            'INSERT INTO `contacts` (`name`, `phone`)
            VALUES (:name, :phone)'
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':phone', $phone);
        $query->execute();
    }

    public function delete(int $id): bool
    {
        $connection = database()->connect();

        $query = $connection->prepare(
            'DELETE FROM `contacts`
            WHERE `id` = :id'
        );
        $query->bindParam(':id', $id);
        $query->execute();

        return $query->rowCount() ? true : false;
    }

    public function getById(int $id): ?Contact
    {
        $connection = database()->connect();

        $query = $connection->prepare(
            'SELECT *
            FROM `contacts`
            WHERE `id` = :id
            LIMIT 1'
        );
        $query->bindParam(':id', $id);
        $query->execute();

        $contact = null;

        if ($temp = $query->fetch(\PDO::FETCH_ASSOC)) {
            $contact = new Contact($temp['name'], $temp['phone'], $id);
        }

        return $contact;
    }

    public function update(int $id, string $name, string $phone): void
    {
        $connection = database()->connect();

        $query = $connection->prepare(
            'UPDATE `contacts`
            SET `name` = :name, `phone` = :phone
            WHERE `id` = :id'
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':id', $id);
        $query->execute();
    }
}
