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
    private string $Password = '';

    public function __construct(string $Name, string $Email, string $Password)
    {
        $this->Name = $Name;
        $this->PasswordVerificator($Password);
        $this->Email = $this->EmailVerificator($Email);
    }

    public function SaveData()
    {
        if ($this->Password != null && $this->Email != null && $this->Name != null) {
            $dateHour = date('Y/m/d H:i:s');

            $bytes = random_bytes(32);
            $token = bin2hex($bytes);

            $conn = \db\ConnectionCreator::createConnection();

            $sqlInsert = "INSERT INTO users (name, email, password, date, token, status) VALUES (:name, :email, :password, :date, :token, :status);";
            
            $statement = $conn->prepare($sqlInsert);

            var_dump($this->Email);

            $statement->bindValue(':name', $this->Name);
            $statement->bindValue(':email', $this->Email);
            $statement->bindValue(':password', $this->Password);
            $statement->bindValue(':date', $dateHour);
            $statement->bindValue(':token', $token);
            $statement->bindValue(':status', 0);

            try {
                $statement->execute();
            } catch (PDOException $e) {
                echo $e;
                $conn = null;
                return false;
            }
            $conn = null;
            

            $url = 'http://localhost/Estudo/Cruds/CrudPhp/app/TokenVerificator.php?token=' . $token;
        

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
            } catch (Exception $e) {
                echo 'Erro ao enviar email: ' . $e->getMessage();
            }
            return true;
        }else{
            return false;
        }
    }

    public function EmailVerificator(string $email)
    {
        //verificar estrutura do email
        //criar token -> salvar no banco -> associar a um link
        //envia email de verificação com o link
        //link roda um código se ve se o token bate com o do banco de dados
        //ativa a conta

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
            return $email;
        }
        
        return false;
    }

    public function PasswordVerificator(string $pass): ?int
    {
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $pass) == 1) {
            $this->Password = $pass;
            return null;
        } else {
            return 1;
        }
    }
}

