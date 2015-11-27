<?php

//require_once '../vendor/autoload.php';

use GuzzleHttp\Client;

class MyTest extends \PHPUnit_Framework_TestCase
{
    public function testIndex()
    {
        $client = new Client();
        $test = $client->request('GET', 'http://localhost:3000/');
        $this->assertEquals('200', $test->getStatusCode());
    }

    public function testGetAll()
    {
        $client = new Client();
        $test = $client->request('GET', 'http://localhost:3000/emojis');
        $this->assertEquals('200', $test->getStatusCode());
    }

    public function testLogout()
    {
        $client = new Client();
        $test = $client->request('GET', 'http://localhost:3000/auth/logout');
        $this->assertEquals('200', $test->getStatusCode());
    }

    public function testLogin()
    {
        $client = new Client();
        $test = $client->request('POST', 'http://localhost:3000/auth/login');
        $this->assertEquals('200', $test->getStatusCode());
    }

    public function testCreateEmoji()
    {
        $client = new Client();
        $test = $client->request('POST', 'https://api-9jamoji.herokuapp.com/emojis',[
            //'auth' => ['Authorization', '']
        ]);
        $this->assertEquals('200', $test->getStatusCode());
    }
}
