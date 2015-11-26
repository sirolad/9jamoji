<?php
/*
 * Connection to database using Illuminate\Database
 */

namespace Sirolad\app;

use Sirolad\app\base\Config;
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$config = new Config();
$config::loadenv();


$driver = getenv('driver');

$capsule->addConnection(array(
    'driver'    => $driver,
    'host'      => getenv('host'),
    'database'  => getenv('database'),
    'username'  => getenv('username'),
    'password'  => getenv('password'),
    'charset'   => $driver == 'mysql' ? 'utf8mb4' : 'utf8',
    'collation' => $driver == 'mysql' ? 'utf8mb4_unicode_ci' : 'utf8_unicode_ci',
    'prefix'    => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();
