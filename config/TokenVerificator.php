<?php 
namespace config;
session_start();
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
        $stmt = $conn->prepare("SELECT token, id FROM users");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($Token, $row['token'])) {
                $sql = "UPDATE users SET status = :newValue WHERE id = :id";
                $bool = true;
                $stmtUpdate = $conn->prepare($sql);
                $stmtUpdate->bindParam(':newValue', $bool);
                $stmtUpdate->bindParam(':id', $row['id']);
                try {
                    $stmtUpdate->execute();
                    $conn = null;
                    return 0;
                } catch (PDOException $e) {
                    $conn = null;
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