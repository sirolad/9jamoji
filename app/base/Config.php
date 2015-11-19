<?php

namespace Sirolad\app\base;

use Dotenv\Dotenv;

/**
*
*/
class Config
{
    public static function loadenv()
    {
        $dotenv = new Dotenv(__DIR__. '/../..');
        $dotenv->load();
    }
}
