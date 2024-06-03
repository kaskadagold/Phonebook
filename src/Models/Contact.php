<?php

namespace App\Models;

class Contact 
{
    public function __construct(public string $name, public string $phone, public int $id) 
    {
    }
}