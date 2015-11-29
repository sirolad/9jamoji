<?php

require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new GuzzleHttp\Client();
try {
    $res = $client->request('GET', 'https://api.github.com/user');
} catch (GuzzleHttp\Exception\ClientException $e) {
    $out = 401;
    //echo $out;
}
echo $out;
//echo $res->getStatusCode();