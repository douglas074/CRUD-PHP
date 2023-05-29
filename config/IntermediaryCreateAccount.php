<?php
session_start();
require_once './Autoload.php';

$password = $_POST['password'];
$email = $_POST['email'];
$name = $_POST['name'];

if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{8,}$/', $password)) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if (preg_match('/^[A-Za-z\s]+$/', $name)) {
            $Aux = new config\Users($name, $email, $password);
            $Aux->SaveData();
        } else {
            echo 'Informe um nome que possua apenas letras e espaços, e ele não pode ser vazio.';
        }
    } else {
        echo 'O email está fora do padrão esperado.';
    }
} else {
    echo 'A senha está fora do padrão esperado. A senha deve ter no mínimo 6 caracteres e conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.';
}