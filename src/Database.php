<?php

namespace App;

class Database
{
    public function connect(): \PDO
    {
        static $connection = null;
        $connectionData = $this->getConnectionData();
    
        if ($connection !== null) {
            return $connection;
        }

        $dsn = 'mysql:host=' . $connectionData['hostname'] 
            . ';dbname=' . $connectionData['database']
        ;

        $connection = new \PDO(
            $dsn,
            $connectionData['username'],
            $connectionData['password'],
        );

        return $connection;
    }

    private function getConnectionData(): array
    {
        return config()->get('database');
    }
}
