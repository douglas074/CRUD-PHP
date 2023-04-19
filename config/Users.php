<?php

namespace config;
class Users
{

    private string $Name;
    private string $Email;
    private string $Password;

    public function __construct(string $Name, string $Email, string $Password)
    {
        $this->Password = $this->PasswordVerificator($Password) == $Password ? $Password : false;
        $this->Name = $Name;
        $this->Email = $Email;
    }

    public function EmailVerificator(string $email):int
    {
       
    }

    public function PasswordVerificator(string $pass): int
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{6,}$/', $pass);
    }

}

