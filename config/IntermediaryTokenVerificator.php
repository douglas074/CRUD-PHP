<?php

require_once './Autoload.php';

$aux = \config\TokenVerificator::TokenVerificator($_GET['token']);
echo $aux;