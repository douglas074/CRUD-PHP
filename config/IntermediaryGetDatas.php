<?php
session_start();

require_once './Autoload.php';

$Aux = \config\Users::GetValues($_SESSION['guid'], 'aaa');



