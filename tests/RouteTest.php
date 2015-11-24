<?php

namespace Sirolad\Test;

use Slim\Environment;
use PHPUnit_Framework_TestCase;

class RoutesTest extends PHPUnit_Framework_TestCase
{

    public function request($method, $path, $options = array())
    {
        // Capture STDOUT
        ob_start();

        // Prepare a mock environment
        Environment::mock(array_merge(array(
            'REQUEST_METHOD' => $method,
            'PATH_INFO' => $path,
            'SERVER_NAME' => 'slim-test.dev',
        ), $options));

        $app = new \Slim\Slim();
        $this->app = $app;
        $this->request = $app->request();
        $this->response = $app->response();

        // Return STDOUT
        return ob_get_clean();
    }

    public function get($path, $options = array())
    {
        $this->request('GET', $path, $options);
    }

    public function testIndex()
    {
        $this->get('/');
        $this->assertEquals('200', $this->response->status());
    }

     /*
    | Mock POST request route
    */
    public function post( $path, $options = array() )
    {
        $this->request('POST', $path, $options);
    }
    /*
    | Mock PUT request route
    */
    public function put( $path, $options = array() )
    {
        $this->request('PUT', $path, $options);
    }
    /*
    | Mock PATCH request route
    */
    public function patch( $path, $options = array() )
    {
        $this->request('PATCH', $path, $options);
    }
    /*
    | Mock DELETE request route
    */
    public function delete( $path, $options = array() )
    {
        $this->request('DELETE', $path, $options);
    }

    /*
    | Test route /emojis
    */
    public function testFindAllEmojis()
    {
        $this->get('/emojis');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /emojis/1 on request
    */
    public function testFindSingleEmojis()
    {
        $this->get('/emojis/1');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /emojis on put request
    */
    public function testCreateEmojis()
    {
        $this->put('/emojis');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /emojis on patch request
    */
    public function testUpdateEmojis()
    {
        $this->patch('/emojis/1');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /emojis on delete request
    */
    public function testDeleteEmojs()
    {
        $this->delete('/emojis/1');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /auth/login on post request
    */
    public function testLoginUser()
    {
        $this->post('/auth/login');
        $this->assertEquals('200', $this->response->status());
    }
    /*
    | Test route /auth/login on post request
    */
    public function testCreateUser()
    {
        $this->post('/auth/register');
        $this->assertEquals('200', $this->response->status());
    }
}

