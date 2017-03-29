<?php


require '../vendor/autoload.php';
// Run app
$app = (new \API\App())->get();
$app->run();