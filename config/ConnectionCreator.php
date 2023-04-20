<?php

namespace config;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $root = 'root';
        $host = 'localhost:3306';
        $pass = 'Cafezinho123!';
        $dbName = 'Crud';

        return new PDO("mysql: host={$host}; dbname={$dbName}", "$root", "$pass");
    }
}
