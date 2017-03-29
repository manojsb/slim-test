<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';

$m = new MongoDB\Client();
$db = $m->jtrade;

$collection = $m->selectCollection($db, 'opportunity_cards');

echo $collection->count();


//$cursor = $collection->find(array(), array('limit' => 2, 'sort' => array('customer_id' => -1)));
$pipeline = array(
    array(
        '$lookup' => array(
            'localField' => "customer_id",
            'from' => 'contacts',
            'foreignField' => "_id",
            'as' => "customerinfo"
        )
    ),
    array(
        '$unwind' => '$customerinfo'
    ),
    array(
        '$sort' => array(
            '_id' => -1
        ),
    ),
    array(
        '$limit' => 3
    )
);


$query = $collection->aggregate($pipeline);

foreach ($query as $q) {
    var_dump($q);
}
?>