<?php

include_once 'vendor/autoload.php';

use Justin\Justin;

$justin = new Justin('RU', true);

$justin->setLogin('Ваш логин')->setPassword('Ваш пароль');

try {

    print_r(

        $justin->listRegions()->getRaw()

    );

} catch (JustinHttpException $exception) {

    echo "JustinHttpException\n";
    echo $exception->getResponse() . "\n";

} catch (JustinResponseException) {

    echo "JustinResponseException\n";
    echo $exception->getResponse() . "\n";

} catch (JustinDataException $exception) {

    echo "JustinDataException\n";
    echo $exception->getResponse() . "\n";

} catch (Exception $exception) {

    echo "Exception\n";
    echo $exception->getResponse() . "\n";

}
