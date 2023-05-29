<?php
namespace db;

use PDO;
use PDOException;

class ConnectionCreator
{
    
    public static function createConnection()
    {
        $host = 'localhost';
        $dbname = 'admin';
        $user = 'admin';
        $password = 'cafe123';

        try {
            $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }
}
