<?php

namespace App\Repositories;

use App\Models\Contact;
use App\Contracts\Repositories\ContactsRepositoryContract;

class ContactsRepository implements ContactsRepositoryContract
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

    public function create(string $name, string $phone): void 
    {
        $data = $this->getContacts();

        $id = array_key_last($data) + 1;
        $data[$id] = new Contact($name, $phone, $id);

        $jsonData = json_encode($data);
        $dataFile = fopen(APP_DIR . '/data/data.json', 'w');
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
    }

    public function update(int $id, string $name, string $phone): void
    {
        $data = $this->getContacts();

        $data[$id]->name = $name;
        $data[$id]->phone = $phone;

        $jsonData = json_encode($data);
        $dataFile = fopen(APP_DIR . '/data/data.json', 'w');
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
    }

    public function delete(int $id): void 
    {
        $data = $this->getContacts();
        
        unset($data[$id]);

        $jsonData = json_encode($data);
        $dataFile = fopen(APP_DIR . '/data/data.json', 'w');
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
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
}
