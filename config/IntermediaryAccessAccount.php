<?php
session_start();
require_once './Autoload.php';
if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password']) && filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)){
    config\Users::AccessAccount($_POST['email'],$_POST['password']);
    exit();
}
    echo "Email ou senha estão fora dos padrões, tente novamente";