<?php

use Estudo\Cruds\CrudPhp\Back\Users;

require('/var/www/html/Estudo/Cruds/CrudPhp/src/Autoload.php');

$user = new Users('douglas', 'pinto@gmaikl.com', 'Cuzinho123!');
var_dump($user);