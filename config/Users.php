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
    public function SaveData(): bool
    {
        $dateHour = date('Y/m/d H:i:s');

        $bytes = random_bytes(32);
        $token = bin2hex($bytes);

        $uuid = Uuid::uuid4();
        $guid = $uuid->toString();

        $conn = \db\ConnectionCreator::createConnection();

        $sqlInsert = "INSERT INTO users (name, email, password, dateHour, token, status, guid) VALUES (:name, :email, :password, :date, :token, :status, :guid);";
        
        $statement = $conn->prepare($sqlInsert);

        $statement->bindValue(':name', $this->Name);
        $statement->bindValue(':email', $this->Email);
        $statement->bindValue(':password', $this->Password);
        $statement->bindValue(':date', $dateHour);
        $statement->bindValue(':token', $token);
        $statement->bindValue(':status', 0);
        $statement->bindValue(':guid', $guid);

        try {
            $statement->execute();
            $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/TokenVerificator.php?token=' . $token;
    
            $this->EmailSend($url);

            $conn = null;
            return 1;
        } catch (PDOException $e) {
            echo 'Erro ao criar conta' . $e;
            $conn = null;
            return false;
        }
        
    
    }
    public static function AccessAccount(string $email, string $password): int
    {
        $conn = \db\ConnectionCreator::createConnection();

        $stmt = $conn->query("SELECT * FROM users WHERE status = 1");
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $dbEmail = $row['email'];
            $dbPassword = $row['password'];

            if ( $dbEmail == $email && password_verify($password, $dbPassword)) {
                $conn = null;
                $_SESSION['guid'] = $row['guid'];                
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['password'] = $row['password'];

                return 1;
            }
        }
        session_destroy();
        $conn = null;
        return 0;
    }
    
  public static function AlterValues(string $guid, string $name, string $email, string $password): bool
  {
    $aux = password_hash($password, PASSWORD_DEFAULT);
    $conn = \db\ConnectionCreator::createConnection();

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

        return 1;
    } catch (PDOException $e) {
        echo 'Erro ao atualizar dados' . $e;
        $conn = null;
        return 0;
    }
  }
    public function EmailSend(string $url):void
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
        
            echo 'Email enviado com sucesso!';
            return;
        } catch (Exception $e) {
            echo 'Erro ao enviar email: ' . $e->getMessage();
            return;
        }
    }

    public function EmailVerificator(string $email):void
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            $this->Email = $email;
            return;
        }
        echo "E-mail inválido, por favor tente novamente";
        return;
    }

    public function PasswordVerificator(string $pass): void
    {
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $pass) == 1) {
            $this->Password = password_hash($pass, PASSWORD_DEFAULT);
            return;
        } else {
            echo "Senha inválida, por favor tente novamente";
            return;
        }
    }
}

