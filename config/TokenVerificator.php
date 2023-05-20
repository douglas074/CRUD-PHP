<?php 
namespace config;

use PDO;
use PDOException;

/**
 * Summary of TokenVerificator
 */
class TokenVerificator{
    /**
     * Summary of TokenVerificator
     * @param mixed $Token
     * @return bool
     */
    public static function TokenVerificator($Token): int
    {
        $conn = \db\ConnectionCreator::createConnection();
        $stmt = $conn->prepare("SELECT token, guid FROM users");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($Token, $row['token'])) {
                $sql = "UPDATE users SET status = :newValue WHERE guid = :guid";
    
                try {
                    $newValue = 1;

                    $stmtUpdate = $conn->prepare($sql);
                    $stmtUpdate->bindParam(':newValue', $newValue);
                    $stmtUpdate->bindParam(':guid', $row['guid']);
                    $stmtUpdate->execute();
                    $conn = null;
                    return 0;
                } catch (PDOException $e) {
                    echo "Erro ao ativar conta: " . $e->getMessage();
                    return 1;
                }
            }
        }
        $conn = null;
        echo "Token inválido";
        return 2;
    }

}