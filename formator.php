<?php

require 'vendor/autoload.php';


//get all countries
$countries = countries();

//var_dump($countries);

$us = country('in');

echo "<pre>";
print_r($us);
echo "</pre>";


/*
foreach ($countries as $key => $value) {
    var_dump($key);
    echo "<br />";

    var_dump($value);

    echo "<br />";
}*/

