<?php
/**
 * Test case for testing the endpoints of https://api-9jamoji.herokuapp.com
 */
namespace Sirolad\Test;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RouteTests extends \PHPUnit_Framework_TestCase
{
    /**s
    * @var string api's url;
     */
    protected $api_url;

    /**
     * @var string Instance of GuzzleHttp
     */
    protected $client;

    /**
     * @var string Instance of GuzzleHttp
     */
    protected $token;

    /**
     * setUp Class constructor
     */
    public function setUp()
    {
        $this->client  = new Client();
        $this->api_url = 'https://api-9jamoji.herokuapp.com';
        $this->token   = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3N1ZWQiOiJodHRwczpcL1wvYXBpLTlqYW1vamkuaGVyb2t1YXBwLmNvbSIsImlzc3VlciI6InNpcm9sYWQiLCJ1c2VyIjoiTmV3dXNlciIsImV4cCI6MTQ0OTA3OTE2Mn0.8oqPh1e2tpGoZGo_TalZrCovY_QfmfxwS9_eXVZOPNs';
    }

    /**
     * testIndex homepage route
     * @return int
     */
    public function testIndex()
    {
        $test = $this->client->request('GET', $this->api_url);
        $this->assertEquals('200', $test->getStatusCode());
        $this->assertInternalType('object', $test->getBody());
        $content = $test->getHeader('content-type')[0];
        $this->assertEquals('text/html;charset=UTF-8', $content);
    }

    /**
     * testGetAll all emojis route
     * @return int
     */
    public function testGetAll()
    {
        $test = $this->client->request('GET', $this->api_url.'/emojis');
        $this->assertEquals('200', $test->getStatusCode());
        $this->assertInternalType('object', $test->getBody());
        $content = $test->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testGetOne all emojis route
     * @return int
     */
    public function testGetOne()
    {
        $test = $this->client->request('GET', $this->api_url.'/emojis/3');
        $this->assertEquals('200', $test->getStatusCode());
        $this->assertInternalType('object', $test->getBody());
        $content = $test->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testLogout
     * @return int
     */
    public function testLogout()
    {
        try {
            $body = $this->client->request('GET', $this->api_url.'/auth/logout');
            $this->assertInternalType('string', $body);
        } catch (ClientException $e) {
            $test = 401;
            $status = '401 Unathorized';
        }

        $this->assertEquals('401', $test);
        $this->assertEquals('401 Unathorized', $status);
    }

    /**
     * testLoginWithoutAuth
     * @return Exception
     */
    public function testLoginWithoutAuth()
    {
        try {
            $this->client->request('POST', $this->api_url.'/auth/login');
        } catch (ClientException $e) {
            $test =  401;
            $status = '401 Unathorized';
        }

        $this->assertEquals('401', $test);
        $this->assertEquals('401 Unathorized', $status);
    }

    /**
     * testCreateEmojiWithoutAuth
     * @return Exception
     */
    public function testCreateEmojiWithoutAuth()
    {
        $test =$this->client->request('POST', $this->api_url.'/emojis');
        $this->assertEquals('200', $test->getStatusCode());
        $this->assertInternalType('object', $test);
        $content = $test->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testPutEmojiWithoutAuth
     * @return Exception
     */
    public function testPutEmojiWithoutAuth()
    {
        try {
            $this->client->request('PUT', $this->api_url.'/emojis/3');
        } catch (ClientException $e) {
            $error = 401;
            $status = '401 Unathorized';
        }

        $this->assertEquals('401', $error);
        $this->assertEquals('401 Unathorized', $status);
    }

    /**
     * testPatchEmojiWithoutAuth
     * @return Exception
     */
    public function testPatchEmojiWithoutAuth()
    {
        try {
            $this->client->request('PATCH', $this->api_url.'/emojis/3');
        } catch (ClientException $e) {
            $test = 401;
            $status = '401 Unathorized';
        }

        $this->assertEquals('401', $test);
        $this->assertEquals('401 Unathorized', $status);
    }

    /**
     * testDeleteEmojiWithoutAuth
     * @return Exception
     */
    public function testDeleteEmojiWithoutAuth()
    {
        try {
            $this->client->request('DELETE', $this->api_url.'/emojis/3');
        } catch (ClientException $e) {
            $test = 401;
            $status = '401 Unathorized';
        }

        $this->assertEquals('401', $test);
        $this->assertEquals('401 Unathorized', $status);
    }

    /**
     * testRegister
     * @return int
     */
    public function testRegister()
    {
        $test = $this->client->request('GET', $this->api_url.'/register');
        $this->assertEquals('200', $test->getStatusCode());
        $this->assertInternalType('object', $test->getBody());
        $content = $test->getHeader('content-type')[0];
        $this->assertEquals('text/html;charset=UTF-8', $content);
    }

    /**
     * testLogoutWithAuth
     * @return JSON
     */
    public function testLogoutWithAuth()
    {
        $body = $this->client->request('GET', $this->api_url.'/auth/logout',[ 'headers' => ['Authorization'=> $this->token]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testLoginWithAuth
     * @return JSON
     */
    public function testLoginWithAuth()
    {
        $body = $this->client->request('POST', $this->api_url.'/auth/login',[ 'headers' => ['Authorization'=> $this->token],'form_params' => [
                            'username' => 'Newuser',
                            'password' => 'newuser'
        ]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testCreateEmojiWithAuth
     * @return JSON
     */
    public function testCreateEmojiWithAuth()
    {
        $body = $this->client->request('POST', $this->api_url.'/emojis',[ 'headers' => ['Authorization'=> $this->token],'form_params' => [
                            'name'      => 'Sunny',
                            'char'      => '😎',
                            'keywords'  => 'Holiday, fun',
                            'category'  => 'Vacation'
        ]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testPutEmojiWithAuth
     * @return JSON
     */
    public function testPutEmojiWithAuth()
    {
        $body = $this->client->request('PUT', $this->api_url.'/emojis/4',[ 'headers' => ['Authorization'=> $this->token],'form_params' => [
                            'name'      => 'Sunny',
                            'char'      => '😎',
                            'keywords'  => 'Holiday, fun',
                            'category'  => 'Vacation'
        ]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testPatchEmojiWithAuth
     * @return JSON
     */
    public function testPatchEmojiWithAuth()
    {
        $body = $this->client->request('PATCH', $this->api_url.'/emojis/4',[ 'headers' => ['Authorization'=> $this->token],'form_params' => [
                            'name'      => 'Noisemaker',
                            'char'      => '😷',
                            'keywords'  => 'discipline,manners',
                            'category'  => 'parenting'
        ]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }

    /**
     * testDeleteEmojiWithAuth
     * @return JSON
     */
    public function testDeleteEmojiWithAuth()
    {
        $body = $this->client->request('DELETE', $this->api_url.'/emojis/3',[ 'headers' => ['Authorization'=> $this->token]]);
        $this->assertInternalType('object' , $body);
        $this->assertEquals('200', $body->getStatusCode());
        $content = $body->getHeader('content-type')[0];
        $this->assertEquals('application/json', $content);
    }
}
