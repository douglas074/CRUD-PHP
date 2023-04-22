<?php

use config\Users;

require_once './Autoload.php';

if (filter_var('do157@gmaio.com', FILTER_VALIDATE_EMAIL) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', 'DInossauro123!') == 1) {

    $Aux = new Users('aaaaaaaaaaaaaaa', 'douglas.guilherme0704@gmail.com','DInossauro123!');
    //$Aux = new Users($_POST['name'],$_POST['email'], $_POST['password']);

    $Aux->SaveData();
}

