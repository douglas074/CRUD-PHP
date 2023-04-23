<?php

use config\Users;

require_once './Autoload.php';

echo $_POST['name'];

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password'])) {
    echo $_POST['name'];

    $Aux = new Users($_POST['name'], $_POST['email'],$_POST['password']);

    $Aux->SaveData();
}

