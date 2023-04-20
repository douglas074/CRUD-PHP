<?php

namespace db;

use PDO;
use PDOException;

class ConnectionCreator
{
    public static function createConnection()
    {
        try {
            $pdo = new PDO('sqlite:./database.db');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
        } catch (PDOException $e) {
            echo 'Erro ao conectar ao banco de dados: ' . $e->getMessage();
        }
    }
}
