<?php
class contactRepository {
    public $jsonData;
    public $data;
    public $dataFile;
    public function getList() {

        $this->dataFile = fopen("data.json", "r");
        if (filesize("data.json")) 
        {
            $this->jsonData = fread($this->dataFile, filesize("data.json"));
        
            if ($this->jsonData) {
                $this->data = json_decode($this->jsonData, true);
            }
        }
        else {
            $this->data = [];
        }
        
        fclose($this->dataFile);
        return $this->data;
    }

    public function addContact($name, $phone) {
        array_push($this->data, ['name'=> $name,'phone'=> $phone]);
        $this->jsonData = json_encode($this->data);
        $this->dataFile = fopen('data.json', "w");
        fwrite($this->dataFile, $this->jsonData);
        fclose($this->dataFile);
    }

    public function deleteContact($id) {
        unset($this->data[$id]);
        $this->jsonData = json_encode($this->data);
        $this->dataFile = fopen('data.json', "w");
        fwrite($this->dataFile, $this->jsonData);
        fclose($this->dataFile);
    }
}

$contacts = new contactRepository();
$contactsList = $contacts->getList();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $newContactName = $_GET["contactName"] ?? null;
    $newContactPhone = $_GET["contactPhone"] ?? null;
}

if (isset($newContactName) && isset($newContactPhone)) {
    $contacts->addContact($newContactName, $newContactPhone);
}

$url = explode('?', $_SERVER['REQUEST_URI']);
$url = $url[0];

if ($url == '/deleting.php') {
    $id = explode('=', $_SERVER['QUERY_STRING'])[1];
    $contacts->deleteContact($id);
}