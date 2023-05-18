<?php
session_start();
require('./Autoload.php');
var_dump($_SESSION);
switch ($_POST['hiddenInput']) {
    case 0:
        if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if ($_POST['name'] != null) {
                $aux = config\Users::AlterValues($_SESSION['guid'], $_POST['name'], $_POST['email'], $_SESSION['password']);
                echo $aux;
            }else{
                echo 'O nome não pode ser nulo';
            }
        }else{
            echo 'O email esta fora do padrão';
        }
        break;
    case 1:
        if (password_verify($_POST['password'], $_SESSION['password'])) {
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password1']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password2']) && $_POST['password2'] == $_POST['password1'] && $_POST['password1'] != null) {
                if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    if ($_POST['name'] != null) {
                        $aux = config\Users::AlterValues($_SESSION['guid'], $_POST['name'], $_POST['email'], $_POST['password1']);
                        echo $aux;
                    }else{
                        echo 'O nome não pode ser nulo';
                    }
                }else{
                    echo 'O email esta fora do padrão';
                }
            }else{
                echo 'As senhas estão fora do padrão';
            }
        }else{
            echo 'Senha incorreta';
        }
        break;
    
    default:
        # code...
        break;
}

