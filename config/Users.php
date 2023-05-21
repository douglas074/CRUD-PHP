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

use Ramsey\Uuid\Uuid;

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

                $bytes = random_bytes(32);
                $token = bin2hex($bytes);
                $tokenHash = password_hash($token, PASSWORD_DEFAULT);
        
                $uuid = Uuid::uuid4();
                $guid = $uuid->toString();

                $sqlInsert = "INSERT INTO users (name, email, password, dateHour, token, status, guid) VALUES (:name, :email, :password, :date, :token, :status, :guid);";
                
                $statement = $conn->prepare($sqlInsert);
        
                $statement->bindValue(':name', $this->Name);
                $statement->bindValue(':email', $this->Email);
                $statement->bindValue(':password', $this->Password);
                $statement->bindValue(':date', $dateHour);
                $statement->bindValue(':token', $tokenHash);
                $statement->bindValue(':status', 0);
                $statement->bindValue(':guid', $guid);
        
                try {
                    $statement->execute();
                    $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/TokenVerificator.php/' . $token;
        
                    if($this->EmailSend($url)){
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

        $stmt = $conn->query("SELECT * FROM users WHERE email = :email AND exclusionStatus = 0 AND status = 0");
        $statement = $conn->prepare($stmt);
        
        $statement->bindValue(':email', $this->Email);
        try {
            $statement->execute();
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            if ($row) {
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

        $stmt = $conn->query("SELECT * FROM users WHERE status = 1");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ( $row['email'] == $email && password_verify($password, $row['password'])) {
                $conn = null;
                $_SESSION['guid'] = $row['guid'];                
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];

                echo 1;
                return;
            }
        }
        session_destroy();
        $conn = null;
        echo 0;
        return;
    }

    public static function AlterValues(string $guid, string $name, string $email, string $password, string $password1): void
    { 
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = $conn->query("SELECT * FROM users WHERE status = 1");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $row['password'])) {
                $aux = password_hash($password1, PASSWORD_DEFAULT);

                $sqlInsert = "UPDATE users SET name = :name, email = :email, password = :pass WHERE guid = :guid";
                $statement = $conn->prepare($sqlInsert);
    
                $statement->bindValue(':guid', $guid);
                $statement->bindValue(':name', $name);
                $statement->bindValue(':email', $email);
                $statement->bindValue(':pass', $aux);
    
                try {
                    $statement->execute();
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $aux;
                    echo 0;
                    return;
                } catch (PDOException $e) {
                    echo 1;
                    $conn = null;
                    return;
                }
            }
        }
        echo 2;
    }   
    public function EmailSend(string $url): bool
    {
        try {
            $transport = new SmtpTransport();
            $options = new SmtpOptions([
                'name' => 'smtp.gmail.com',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'connection_class' => 'login',
                'connection_config' => [
                    'username' => 'do157.nunes@gmail.com',
                    'password' => 'erefbuqzqilcuhgs',
                    'ssl' => 'tls',
                ],
            ]);
            $transport->setOptions($options);
        
            $message = new Message();
            $message->setEncoding('UTF-8');

            $html = new MimePart('<h4>Olá ' . $this->Name . '<br> Por favor, acesse o link abaixo para confirmar seu e-mail </h4><br><h5>' . $url . '</h5>');
            $html->type = 'text/html';
        
            $body = new MimeMessage();
            $body->addPart($html);
            $message->addTo($this->Email)
                    ->addFrom('do157.nunes@gmail.com')
                    ->setSubject('Verificação de conta')
                    ->setBody($body);

            $transport->send($message);
            return 1;
        } catch (Exception $e) {
            echo 'Erro ao enviar email: ' . $e->getMessage();
            return 0;
        }
    }

}