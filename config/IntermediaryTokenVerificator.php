<?php


require_once './Autoload.php';

echo \config\TokenVerificator::TokenVerificator($_GET['token']);
