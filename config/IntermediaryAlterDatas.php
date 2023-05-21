<?php
session_start();
require('./Autoload.php');
switch ($_POST['hiddenInput']) {
    case '0':
        if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
            if (preg_match('/^[A-Za-z\s]+$/', $_POST['name']) && $_POST['name'] != null) {
                config\Users::AlterValues($_SESSION['guid'], $_POST['name'], $_POST['email'], $_SESSION['password'], $_SESSION['password']);
            }else{
                echo 'O nome não pode ser nulo';
            }
        }else{
            echo 'O email esta fora do padrão';
        }
        break;
    case '1':
            if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password1']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password2'])) {
                if ($_POST['password1'] === $_POST['password2']) {
                    if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        if (preg_match('/^[A-Za-z\s]+$/', $_POST['name']) && $_POST['name'] != null) {
    
                            config\Users::AlterValues($_SESSION['guid'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['password1']);
                        }else{
                            echo 'Informe um nome que possua apenas letras e espaços, e ele não pode ser vazio neh';
                        }
                    }else{
                        echo 'O email esta fora do padrão';
                    }
                }else{
                    echo 'As senhas não coincidem';
                }
            }else{
                echo 'As senhas estão fora do padrão';
            }
        break;
    
    default:
        echo 'para de mexer no código mona';
        break;
}

