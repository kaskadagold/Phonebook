<?php

namespace App\Repositories;

use App\Contracts\Repositories\ContactsRepositoryContract;
use App\Models\Contact;
use PDO;

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

        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Contact::class, ['', '', -1]);
        $result = [];

        while ($temp = $query->fetch()) {
            $result[] = $temp;
        }

        return $result;
    }

    public function create(string $name, string $phone): bool
    {
        $connection = database()->connect();

        $check = $this->checkPresense($connection, null, $name, $phone);
        $created = false;

        if (! $check) {
            $query = $connection->prepare(
                'INSERT INTO `contacts` (`name`, `phone`)
                VALUES (:name, :phone)'
            );
            $query->bindParam(':name', $name);
            $query->bindParam(':phone', $phone);
            $query->execute();

            $created = true;
        }

        return $created;
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
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Contact::class, ['', '', -1]);

        if ($temp = $query->fetch()) {
            $contact = $temp;
        }

        return $contact;
    }

    public function update(int $id, string $name, string $phone): bool
    {
        $connection = database()->connect();

        $check = $this->checkPresense($connection, $id, $name, $phone);
        $updated = false;

        if (! $check) {
            $query = $connection->prepare(
                'UPDATE `contacts`
                SET `name` = :name, `phone` = :phone
                WHERE `id` = :id'
            );
            $query->bindParam(':name', $name);
            $query->bindParam(':phone', $phone);
            $query->bindParam(':id', $id);
            $query->execute();

            $updated = true;
        }

        return $updated;
    }

    private function checkPresense(PDO $connection, ?int $id, string $name, string $phone): bool
    {
        $query = $connection->prepare(
            'SELECT `id`
            FROM `contacts`
            WHERE `name` = :name AND `phone` = :phone AND `id` != :id'
        );
        $query->bindParam(':name', $name);
        $query->bindParam(':phone', $phone);
        $query->bindParam(':id', $id);

        $query->execute();

        return $query->fetch() ? true : false;
    }
}
