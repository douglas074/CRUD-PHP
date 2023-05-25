<?php 
session_start();
require('./Autoload.php');

if ($_POST['deleteInput'] == 1) {
    config\Users::DeleteAccount($_SESSION['guid']);
}else{
    echo "Para de mexer no código";
}
