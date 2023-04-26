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
    public static function TokenVerificator($Token): bool
    {
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = $conn->query("SELECT token FROM users");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dbToken = $row['token'];

            if ($dbToken == $Token) {
                $newValue = 1;
                
                $sql = "UPDATE users SET status = :newValue WHERE token = :token";

                try {
                    $stmtUpdate = $conn->prepare($sql);

                    $stmtUpdate->bindParam(':newValue', $newValue);
                    $stmtUpdate->bindParam(':token', $Token);
                    $stmtUpdate->execute();
                    $conn = null;
                    echo "Conta ativada, você será redirecionado para que possa fazer o login";
                    return true;

                } catch (PDOException $e) {
                    echo "Erro ao ativar conta: " . $e->getMessage();
                    return false;
                }
            }
        }
        $conn = null;
        echo "Token inválido";
        return false;
    }

}