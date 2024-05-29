<?php

require_once "ContactRepository.php";

function validateInputString(string $str): string {
    $str = trim($str);
    $str = stripslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

$url = $_SERVER['REQUEST_URI'] ?? null;

$contacts = new ContactRepository();
$contactsList = $contacts->getList();

if (str_starts_with($url, '/adding.php')) { 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $contactName = $_POST["contactName"] ?? '';
        $contactPhone = $_POST["contactPhone"] ?? '';
        $newContactName = validateInputString($contactName);
        $newContactPhone = validateInputString($contactPhone);
        if ($newContactName !== '' && $newContactPhone !== '') {
            
            $contacts->addContact($newContactName, $newContactPhone);
            
            header(header: ('Location: /'));
        }
    }
    
} elseif (str_starts_with($url, '/deleting.php')) {

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $idTemp = $_GET['id'] ?? '';
        $id = intval(validateInputString($idTemp));
        $contacts->deleteContact($id);

        header(header: ('Location: /'));
    }
}


