<?php
use config\Users;

require_once './Autoload.php';

if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password']) && filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) && preg_match('/^[A-Za-z\s]+$/', $_POST['name']) && $_POST['name'] != null){
    $Aux = new Users($_POST['name'], $_POST['email'], $_POST['password']);
    $Aux->SaveData();
}else{
    echo "Dados inválidos, verifique se seu nome possui apenas letras e espaços, seu email esteja na estrutura correta de email e que sua senha tenha no minimo uma letra maiusula, um numero e um caratere especial";
}



