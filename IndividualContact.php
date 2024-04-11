<?php 

class IndividualContact 
{
    public $name;
    public $phone;
    public $id;

    function __construct(string $name, string $phone, int $id) 
    {
        $this->name = $name;
        $this->phone = $phone;
        $this->id = $id;
    }
}