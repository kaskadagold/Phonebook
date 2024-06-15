<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Contracts\Repositories\ContactsRepositoryContract;

class ContactsRepositoryJSON implements ContactsRepositoryContract
{
    public function getContacts(): array 
    {
        $dataFile = fopen(APP_DIR . '/data/data.json', 'r');
        if (filesize(APP_DIR . '/data/data.json')) 
        {
            $jsonData = fread($dataFile, filesize(APP_DIR . '/data/data.json'));
        
            if ($jsonData) {
                $dataTemp = json_decode($jsonData, true);
            }
        }
        else {
            $dataTemp = [];
        }
        
        $data = [];
        foreach ($dataTemp as $key => $value) {
            $name = $value['name'] ?? null;
            $phone = $value['phone'] ?? null;
            $id = $value['id'] ?? null;
            $person = new Contact($name, $phone, $id);
            $data[$key] = $person;
        }
        fclose($dataFile);

        return $data;
    }

    public function create(string $name, string $phone): bool
    {
        $data = $this->getContacts();

        $check = $this->checkPresense($data, $name, $phone);
        $created = false;

        if (! $check) {
            $id = array_key_last($data) + 1;
            $data[$id] = new Contact($name, $phone, $id);

            $this->writeToFile($data);

            $created = true;
        }

        return $created;
    }

    public function update(int $id, string $name, string $phone): bool
    {
        $data = $this->getContacts();

        $check = $this->checkPresense($data, $name, $phone);
        $updated = false;

        if (! $check) {
            $data[$id]->name = $name;
            $data[$id]->phone = $phone;

            $this->writeToFile($data);

            $updated = true;
        }

        return $updated;
    }

    public function delete(int $id): bool
    {
        $data = $this->getContacts();

        if (isset($data[$id])) {
            unset($data[$id]);

            $this->writeToFile($data);

            return true;
        } else {
            return false;
        }
    }

    public function getById(int $id): ?Contact
    {
        $dataFile = fopen(APP_DIR . '/data/data.json', 'r');
        $data = null;

        if (filesize(APP_DIR . '/data/data.json')) 
        {
            $jsonData = fread($dataFile, filesize(APP_DIR . '/data/data.json'));
        
            if ($jsonData) {
                $dataTemp = json_decode($jsonData, true);
                if (isset($dataTemp[$id])) {
                    $data = new Contact($dataTemp[$id]['name'], $dataTemp[$id]['phone'], $id);
                }
                
            }
        }
        fclose($dataFile);

        return $data;
    }

    private function writeToFile(array $data): void
    {
        $jsonData = json_encode($data);
        $dataFile = fopen(APP_DIR . '/data/data.json', 'w');
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
    }

    private function checkPresense(array $data, string $name, string $phone): bool
    {
        foreach ($data as $item) {
            if ($item['name'] === $name && $item['phone'] === $phone) {
                return true;
            }
        }

        return false;
    }
}
