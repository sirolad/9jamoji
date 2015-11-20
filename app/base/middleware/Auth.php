<?php

namespace Sirolad\app\base\middleware;

use Slim\Slim;

class Auth
{
    public static function authentication(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');


    }
}