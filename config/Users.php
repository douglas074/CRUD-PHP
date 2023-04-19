<?php

namespace Estudo\Cruds\CrudPhp\Back;
class Users
{

    private string $Name;
    private string $Email;
    private string $Password;

    public function __construct(string $Name, string $Email, string $Password)
    {
        $this->Password = $this->PasswordVerificator($Password) == $Password ? $Password : null;
        $this->Name = $Name;
        $this->Email = $Email;

    }

    public function PasswordVerificator(string $pass): int
    {
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{6,}$/', $pass);
    }

}

