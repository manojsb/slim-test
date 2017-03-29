<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


require 'vendor/autoload.php';

$m = new MongoDB\Client();
$m->example->users;
var_dump($m);
die;

// define db
$db = $m->getManager();

// definne collection
$collection = $db->foo;


// data to be inserted
$doc = array(
    "name" => "MongoDB",
    "type" => "database",
    "count" => 1,
    "info" => (object) array("x" => 203, "y" => 102),
    "versions" => array("0.9.7", "0.9.8", "0.9.9")
);

// run query
$collection->insert($doc);

$document = $collection->findOne();

var_dump($document);
