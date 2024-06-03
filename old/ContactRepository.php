<?php

require_once "IndividualContact.php";

class ContactRepository 
{
    public function getList(): array 
    {
        $dataFile = fopen("data.json", "r");
        if (filesize("data.json")) 
        {
            $jsonData = fread($dataFile, filesize("data.json"));
        
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
            $person = new IndividualContact($name, $phone, $id);
            $data[$key] = $person;
        }
        fclose($dataFile);

        return $data;
    }

    public function addContact($name, $phone): void 
    {
        $data = $this->getList();

        $id = array_key_last($data) + 1;
        $data[$id] = new IndividualContact($name, $phone, $id);

        $jsonData = json_encode($data);
        $dataFile = fopen('data.json', "w");
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
    }

    public function deleteContact(int $id): void 
    {
        $data = $this->getList();
        
        unset($data[$id]);

        $jsonData = json_encode($data);
        $dataFile = fopen('data.json', "w");
        fwrite($dataFile, $jsonData);
        fclose($dataFile);
    }
}
