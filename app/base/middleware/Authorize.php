<?php

namespace Sirolad\app\base\middleware;

use Slim\Slim;
use Exception;
use Firebase\JWT\JWT;
use Sirolad\app\base\Config;
use Sirolad\app\base\models\User;
use Sirolad\app\base\errors\Errors;

class Authorize
{
    public static function authentication(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $token = $app->request->headers->get('Authorization');

        if (! $token) {
            return Errors::error401('Valid Authorization Credentials Missing, login to get one.');
        } else {

            $config = new Config();
            $config::loadenv();

            $key = getenv('jwt_key');
            $algorithm = array('HS256');
            try {
                $decode_jwt = JWT::decode($token,$key,$algorithm);
            } catch (Exception $e) {
                $app->halt(504, json_encode(['status' => 404, 'message' => 'The token supplied is invalid!.']));
            }
            return $decode_jwt->user;
        }
    }
}