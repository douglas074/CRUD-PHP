<?php
require('./Autoload.php');

if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    config\Users::resetPassword($_POST['email']);
} else {
    echo 'O email está fora do padrão esperado.';
}