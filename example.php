<?php

include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

print_r(

    $justin->listRegions()->getRaw()

);
