<?php

include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('RU', true);

$justin->setLogin('Exchange')->setPassword('Exchange');

print_r(

    $justin->listRegions()->getRaw()

);
