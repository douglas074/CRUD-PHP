<?php
session_start();
require('./Autoload.php');

if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password1'])) {
    if ($_POST['password1'] === $_POST['password']) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            config\Users::changePassword($_POST['id'], $_POST['email'], $_POST['password']);
        }else{
            echo 'Email inválido.';
        }
    }else{
        echo 'As senhas não coincidem';
    }
}else{
    echo 'As senhas estão fora do padrão';
}
