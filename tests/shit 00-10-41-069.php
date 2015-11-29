<?php

require_once '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

$client = new GuzzleHttp\Client();
try {
    $client->request('GET', 'https://github.com/_abc_123_404');
} catch (ClientException $e) {
    $b= $e->getResponse();
}
//echo $res->getStatusCode();
var_dump($b);