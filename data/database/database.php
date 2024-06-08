<?php

function connectToDB(array $config): PDO
{
    static $connection = null;
    
    if ($connection !== null) {
        return $connection;
    }

    $dsn = 'mysql:host=' . $config['hostname'] . ';dbname=' . $config['database'] . ';charset=' . $config['charset'];

    $connection = new PDO(
        $dsn,
        $config['username'],
        $config['password'],
    );

    return $connection;
}
