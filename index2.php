<?php

require('CurlUtil.php');

$url = "http://localhost/jacktrade/api/opportunityApi.php/filterCards";
$method = 'POST';

$cutil = new CurlUtil();

$obj = array(
    'is_archive' => false,
    'filterCriteria' => [
        "filters" => [
            "field" => "board_id",
            "value" => "58a159f126148d057a35240a",
            "operator" => "="
        ],
        "sort" => [],
        "skip" => 0,
        "limit" => 10
    ],
    'access_token' => '9cgIZ6Yh4wrvkxtBP0s1zpy2zRtDr7MM5aRfGwWb',
    'userId' => '58a159fc26148d057a352439',
    'bzobjver' => 2
);


$t = $cutil->exec($method, $url, $obj);







