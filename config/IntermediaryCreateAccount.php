<?php

use config\Users;

require_once './Autoload.php';

$Aux = new Users('aaaaaaaaa', 'dddddddddddd', 'Dinossauro123!');

var_dump($Aux->SaveData());