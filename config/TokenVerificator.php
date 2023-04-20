<?php

namespace config;

use PDO;
use PDOException;

class TokenVerificator{
    public static function TokenVerificator($Token): bool
    {

        $conn = \db\ConnectionCreator::createConnection();

        $stmt = $conn->query("SELECT token FROM User");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $token = $row['token'];
            

        }

        $conn = null;

        return true;
    }
}