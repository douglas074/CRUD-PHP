<?php

namespace config;

use PDO;
use PDOException;

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
            $conn = \db\ConnectionCreator::createConnection();

            $sqlInsert = "INSERT INTO users (name, email, password, status, date) VALUES (:name, :email, :password, :status, :registration_time);";
            
            $statement = $conn->prepare($sqlInsert);

            $statement->bindValue(':name', $this->Name);
            $statement->bindValue(':email', $this->Email);
            $statement->bindValue(':password', $this->Password);
            $statement->bindValue(':status', 0);
            $statement->bindValue(':registration_time', $dateHour);

            try {
                $statement->execute();
            } catch (PDOException $e) {
                echo $e;
                $conn = null;
                return false;
            }
            $conn = null;
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

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $bytes = random_bytes(32);
            $token = bin2hex($bytes);

            $conn = \db\ConnectionCreator::createConnection();

            $sqlInsert = "INSERT INTO users (token) VALUES (:token);";
            
            $statement = $conn->prepare($sqlInsert);

            $statement->bindValue(':token', $token);

            try {
                $statement->execute();
            } catch (PDOException $e) {
                echo $e;
                $conn = null;
                return false;
            }
            $conn = null;

            $url = 'http://exemplo.com/verificar.php?token=' . $token;

            $assunto = 'Verificação de E-mail';
            $mensagem = 'Olá, acesse o link abaixo para poder ativar sua conta <br>'. $url;
            
            mail($email, $assunto, $mensagem);
    
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

