<?php
use config\Users;

require_once './Autoload.php';

if(preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password']) && filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) && $_POST['name'] != null){
    $Aux = new Users($_POST['name'], $_POST['email'], $_POST['password']);
    $Aux->SaveData();

}else{
    echo "Erro ao criar conta";
}



