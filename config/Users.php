<?php

namespace config;

use PDO;
use PDOException;
use config\ConnectionCreator;
class Users
{

    private string $Name;
    private string $Email;
    private string $Password = '';

    public function __construct(string $Name, string $Email, string $Password)
    {
        $this->Name = $Name;
        $this->PasswordVerificator($Password);
        $this->Email = $Email;        
    }

    public function SaveData()
    {
        if ($this->Password != null && $this->Email != null && $this->Name != null) {
            $dateHour = date('Y/m/d H:i:s');
            $conn = ConnectionCreator::createConnection();

            $sqlInsert = "INSERT INTO user (name, email, password, status, registration_time) VALUES (:name, :email, :password, :status, :registration_time);";
            
            $statement = $conn->prepare($sqlInsert);

            $statement->bindValue(':name', $this->Name);
            $statement->bindValue(':email', $this->Email);
            $statement->bindValue(':password', $this->Password);
            $statement->bindValue(':status', true);
            $statement->bindValue(':registration_time', $dateHour);

            try {
                $statement->execute();
            } catch (PDOException $e) {
                echo $e;
                return false;
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

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $bytes = random_bytes(32);
            $token = bin2hex($bytes);
            
            $destinatario = 'exemplo@exemplo.com';
            $assunto = 'Teste de e-mail';
            $mensagem = 'Olá, isso é um teste de e-mail!';
            
            // Define os cabeçalhos do e-mail
            $headers = 'From: remetente@exemplo.com' . "\r\n" .
                'Reply-To: remetente@exemplo.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();
            
            // Envia o e-mail usando a função mail()
            mail($destinatario, $assunto, $mensagem, $headers);
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

