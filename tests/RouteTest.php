<?php
/**
 * Test case for testing the endpoints of https://api-9jamoji.herokuapp.com
 */
namespace Sirolad\Test;

use GuzzleHttp\Client;

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
     * setUp Class constructor
     */
    public function setUp()
    {
        $this->client = new Client();
        $this->api_url = 'https://api-9jamoji.herokuapp.com';
    }

    /**
     * testIndex homepage route
     * @return int
     */
    public function testIndex()
    {
        $test = $this->client->request('GET', $this->api_url);
        $this->assertEquals('200', $test->getStatusCode());
    }

    /**
     * testGetAll all emojis route
     * @return int
     */
    public function testGetAll()
    {
        $test = $this->client->request('GET', $this->api_url.'/emojis');
        $this->assertEquals('200', $test->getStatusCode());
    }

    /**
     * testLogout
     * @return int
     */
    public function testLogout()
    {
        $test = $this->client->request('GET', $this->api_url.'/auth/logout');
        $this->assertEquals('200', $test->getStatusCode());
    }

    /**
     * testLoginWithoutAuth
     * @return Exception
     */
    public function testLoginWithoutAuth()
    {
        try {
            $this->client->request('POST', $this->api_url.'/auth/login', [
                'auth' => ['juice','']]);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $test =  401;
        }

        $this->assertEquals(401, $test);
    }

    // /**
    //  * testCreateEmojiWithoutAuth
    //  * @return Exception
    //  */
    // public function testCreateEmojiWithoutAuth()
    // {
    //     try {
    //         $this->client->request('POST', $this->api_url.'/emojis');
    //     } catch (GuzzleHttp\Exception\ClientException $e) {
    //         $test = 401;
    //     }

    //     $this->assertEquals(401, $test);
    // }

    // /**
    //  * testPutEmojiWithoutAuth
    //  * @return Exception
    //  */
    // public function testPutEmojiWithoutAuth()
    // {
    //     try {
    //         $this->client->request('PUT', $this->api_url.'/emojis/3');
    //     } catch (GuzzleHttp\Exception\ClientException $e) {
    //         $test = 401;
    //     }

    //     $this->assertEquals(401, $test);
    // }

    // /**
    //  * testPatchEmojiWithoutAuth
    //  * @return Exception
    //  */
    // public function testPatchEmojiWithoutAuth()
    // {
    //     try {
    //         $this->client->request('PATCH', $this->api_url.'/emojis/3');
    //     } catch (GuzzleHttp\Exception\ClientException $e) {
    //         $test = 401;
    //     }

    //     $this->assertEquals(401, $test);
    // }

    // /**
    //  * testDeleteEmojiWithoutAuth
    //  * @return Exception
    //  */
    // public function testDeleteEmojiWithoutAuth()
    // {
    //     try {
    //         $this->client->request('DELETE', $this->api_url.'/emojis/3');
    //     } catch (GuzzleHttp\Exception\ClientException $e) {
    //         $test = 401;
    //     }

    //     $this->assertEquals(401, $test);
    // }

    /**
     * testRegister
     * @return int
     */
    public function testRegister()
    {
        $test = $this->client->request('GET', $this->api_url.'/register');
        $this->assertEquals('200', $test->getStatusCode());
    }
}
