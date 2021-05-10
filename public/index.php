<?php

require_once __DIR__.'/../vendor/autoload.php';

use App\App;
use App\Lib\Erro;

session_start();

error_reporting(E_ALL & ~E_NOTICE);


try {
    $app = new App();
    $app->run();
} catch (\Exception $e) {
    $oError = new Erro($e);
    $oError->render();
}
/*
echo "Hello World";
*/