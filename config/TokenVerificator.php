<?php

namespace config;

use PDO;
use PDOException;

class TokenVerificator{
    public static function TokenVerificator($Token): bool
    {
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = $conn->query("SELECT token FROM users");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dbToken = $row['token'];

            if ($dbToken == $Token) {

                return true;
            }
            
        }
        $conn = null;
        return false;
    }
}