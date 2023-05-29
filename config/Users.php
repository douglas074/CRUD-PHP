<?php

namespace config;

require"../vendor/autoload.php";

use FFI\Exception;
use PDO;
use PDOException;

use Laminas\Mail\Message;
use Laminas\Mail\Transport\Smtp as SmtpTransport;
use Laminas\Mail\Transport\SmtpOptions;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Part as MimePart;

class Users
{
    private string $Name;
    private string $Email;
    private string $Password;
    public function __construct(string $Name, string $Email, string $Password)
    {
        $this->Name = $Name;
        $this->Password = password_hash($Password, PASSWORD_DEFAULT);
        $this->Email =  (filter_var($Email, FILTER_VALIDATE_EMAIL)) ? $Email : exit();
        
    }
    public function SaveData()
    {
        switch ($this->accountVerificator()) {
            case 0:
                echo 0;
                break;

            case 1:
                $conn = \db\ConnectionCreator::createConnection();

                $dateHour = date('Y/m/d H:i:s');

                $result = users::GenereteToken();
                $token = $result[0];
                $tokenHash = $result[1];

                $sqlInsert = "INSERT INTO users (name, email, password, token, createdate) VALUES (:name, :email, :password, :token,  :date);";
                
                $statement = $conn->prepare($sqlInsert);
        
                $statement->bindValue(':name', $this->Name);
                $statement->bindValue(':email', $this->Email);
                $statement->bindValue(':password', $this->Password);
                $statement->bindValue(':date', $dateHour);
                $statement->bindValue(':token', $tokenHash);

                try {
                    $statement->execute();
                    $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/TokenVerificator.php/' . $token;
        
                    if($this->EmailSend($url, $this->Name, $this->Email, 'Ativação de conta')){
                        $conn = null;
                        echo 1;
                        return;
                    }
                    echo 4;
                } catch (PDOException $e) {
                    $conn = null;
                    echo 4;
                    return;
                }
                $conn = null;
                break;
                case 2:
                    echo 2;
                    break;
            
            default:
                echo 3;
                break;
        }
    }
    public function accountVerificator(): int
    {
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = "SELECT * FROM users WHERE email = :email AND exclusionstatus = false AND status = false";
        $statement = $conn->prepare($stmt);
        $statement->bindValue(':email', $this->Email);
        try {
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if (!$row) {
                return 1;
            }
            return 2;
        } catch (PDOException $e) {
            $conn = null;
            return 0;
        }
    }
    public static function AccessAccount(string $email, string $password): void
    {
        $conn = \db\ConnectionCreator::createConnection();
        $stmt = "SELECT * FROM users WHERE email = :email AND exclusionStatus = false";
        $statement = $conn->prepare($stmt);
        $statement->bindValue(':email', $email);
        try {
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row){
                if ($row['status']) {
                    if (password_verify($password, $row['password'])) {
                        $conn = null;
                        $_SESSION['id'] = $row['id'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['password'] = $row['password'];
                        echo 1;
                        return;
                    }else{
                        $conn = null;
                        echo 2;
                        return;
                    }
                } else{
                    echo (users::ResendEmailVerificator($email)) ? 3 : 4;
                    return;
                }
            }else{
                session_destroy();
                $conn = null;
                echo 0;
                return;
            }
        } catch (\Throwable $th) {
            echo 1;
            $conn = null;
            return;
        }
    }
    public static function GenereteToken(): array
    {
        $bytes = random_bytes(32);
        $token = bin2hex($bytes);
        $tokenHash = password_hash($token, PASSWORD_DEFAULT);
        $array = array($token, $tokenHash);
        return $array;
    }

    public static function ResendEmailVerificator(string $email): bool
    {
    $conn = \db\ConnectionCreator::createConnection();
    $result = users::GenereteToken();
    $token = $result[0];
    $tokenHash = $result[1];

    $stmt = "SELECT * FROM users WHERE status = false AND email = :email";
    $statement = $conn->prepare($stmt);
    $statement->bindValue(':email', $email);
    try {
        $statement->execute();
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $id = $row['id'];

            $sqlUpdate = "UPDATE users SET token = :tokenHash WHERE id = :id ";
            $statement = $conn->prepare($sqlUpdate);
            $statement->bindValue(':tokenHash', $tokenHash);
            $statement->bindValue(':id', $id);
            $statement->execute();  

            try {
                $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/TokenVerificator.php/' . $token;
                return users::EmailSend($url, $row['name'], $email, 'Reenvio de ativação de conta');
            } catch (PDOException $e) {
                $conn->rollBack();
                $conn = null;
                return false;
            }
        }
    } catch (\Throwable $th) {
        $conn->rollBack();
        $conn = null;
        return false;
    }
    $conn->rollBack();
    $conn = null;
    return false;
    }
    public static function AlterValues(string $id, string $name, string $email, string $password, string $password1): void
    { 
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = "SELECT * FROM users WHERE status = true AND id = :guid";
        $statement = $conn->prepare($stmt);
        $statement->bindValue(':guid', $id);
        $statement->execute();

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $aux = password_hash($password1, PASSWORD_DEFAULT);

                $sqlInsert = "UPDATE users SET name = :name, email = :email, password = :pass WHERE id = :id";
                $statement = $conn->prepare($sqlInsert);

                $statement->bindValue(':id', $id);
                $statement->bindValue(':name', $name);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':pass', $aux);

                try {
                    $statement->execute();
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $aux;
                    $conn = null;
                    echo 0;
                    return;
                } catch (PDOException $e) {
                    echo 1;
                    $conn = null;
                    return;
                }
            }
        }
        $conn = null;
        echo 2;
    }
    public static function changePassword(string $id, string $email, string $pass)
    {
        $conn = \db\ConnectionCreator::createConnection();
        $stmt = "SELECT * FROM users WHERE status = true AND id = :id";
        $statement = $conn->prepare($stmt);
        $statement->bindValue(':id', $id);
        try {
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if (!password_verify($pass, $row['password'])) {
                if ($email == $row['email'] && $row['id'] == $id) {
                    $pass = password_hash($pass, PASSWORD_DEFAULT);
                    $stmt = "UPDATE users 
                    SET password = :pass 
                    WHERE status = true AND email = :email AND id = :id";
                    $statement = $conn->prepare($stmt);
                    $statement->bindValue(':pass', $pass);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':id', $id);
                    try {
                        $statement->execute();
                        $conn = null;
                        echo 0;
                        return;
                    } catch (\Throwable $th) {
                        $conn = null;
                        echo 1;
                        return;
                    }
                }else {
                    $conn = null;
                    echo 2;
                    return;
                }
            }else {
                $conn = null;
                echo 3;
                return;
            }
        } catch (\Throwable $th) {
            $conn = null;
            echo 4;
            return;
        }
    }
    public static function logOut(): void
    {
        echo (session_destroy()) ? 0 : 1 ;
    }
    public static function resetPassword(string $email)
    {
        $conn = \db\ConnectionCreator::createConnection();
        $stmt = "SELECT name, id FROM users WHERE email = :email AND status = true";
        $statement = $conn->prepare($stmt);
        $statement->bindValue(':email', $email);
        try {
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);;
            if ($row){
                $name = $row['name'];
                $id = $row['id'];
                $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/ChangePassword.php/' . $id . '/';
                echo users::EmailSend($url, $name, $email, 'Redifinição de senha');
                $conn = null;
                return;
            }
            $conn = null;
            return;
        }catch (\Throwable $th) {
            $conn = null;
            echo 'Erro inesperado';
            return;
        }
    }
    public static function DeleteAccount(string $id): void
    {
        $dateHour = date('Y/m/d H:i:s');
        $conn = \db\ConnectionCreator::createConnection();
        $sql = "UPDATE users SET status = false, exclusionDate = :date, exclusionStatus = true WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->bindValue(':date', $dateHour);
        $statement->bindValue(':id', $id);
        try {
            $statement->execute();
            session_destroy();
            echo 0;
            $conn = null;
            return;
        } catch (PDOException $e) {
            echo 1;
            $conn = null;
            return;
        }
    }
    public static function EmailSend(string $url, string $name, string $email, string $status): bool
    {
        try {
            $transport = new SmtpTransport();
            $options = new SmtpOptions([
                'name' => 'smtp.gmail.com',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'connection_class' => 'login',
                'connection_config' => [
                    'username' => /*email que vai enviar o email de verificação*/ '',
                    'password' => /*senha do app gmail da sua conta*/ '',
                    'ssl' => 'tls',
                ],
            ]);
            $transport->setOptions($options);
        
            $message = new Message();
            $message->setEncoding('UTF-8');

            $html = new MimePart('<h4>Olá ' . $name . '<br> Por favor, acesse o link abaixo para confirmar seu e-mail </h4><br><h5>' . $url . '</h5>');
            $html->type = 'text/html';
        
            $body = new MimeMessage();
            $body->addPart($html);
            $message->addTo($email)
                    ->addFrom('' /*email que vai enviar, remetente*/ )
                    ->setSubject($status)
                    ->setBody($body);

            $transport->send($message);
            return 1;
        } catch (Exception $e) {
            echo 'Erro ao enviar email: ' . $e->getMessage();
            return 0;
        }
    }
}