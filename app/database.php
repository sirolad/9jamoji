<?php

namespace Sirolad\app;

use Sirolad\app\base\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$config = new Config();
$config::loadenv();

$capsule->addConnection(array(
    'driver'    => getenv('driver'),
    'host'      => getenv('host'),
    'database'  => getenv('database'),
    'username'  => getenv('username'),
    'password'  => getenv('password'),
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();
