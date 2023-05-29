<?php
session_start();
require_once('./Autoload.php');

switch ($_POST['hiddenInput']) {
    case '0':
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password'])) {
            if (password_verify($_POST['password'], $_SESSION['password'])) {
                if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    if (preg_match('/^[A-Za-z\s]+$/', $_POST['name']) && $_POST['name'] != null) {
                        config\Users::AlterValues($_SESSION['id'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['password']);
                    }else{
                        echo 'Informe um nome que possua apenas letras e espaços, e ele não pode ser vazio neh';
                    }
                }else{
                    echo 'O email esta fora do padrão';
                }
            }else{
                echo'A senha que você informou não coincide com a que está no nosso sistema.';
            }
        } else{
            echo 'As senhas estão fora do padrão';
        }
        break;
    case '1':
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password1']) && preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?])[\w!@#$%^&*()_+\-=[\]{};:\'"\\|,.<>\/?]{6,}$/', $_POST['password2'])) {
                if (password_verify($_POST['password'], $_SESSION['password'])) {
                if ($_POST['password1'] === $_POST['password2']) {
                    if (filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        if (preg_match('/^[A-Za-z\s]+$/', $_POST['name']) && $_POST['name'] != null) {
                            config\Users::AlterValues($_SESSION['id'], $_POST['name'], $_POST['email'], $_POST['password'], $_POST['password1']);
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
                echo'A senha que você informou não coincide com a que está no nosso sistema.';
            }
        } else{
            echo 'As senhas estão fora do padrão';
        }
        break;
    default:
        echo 'para de mexer no código mona';
        break;
}

