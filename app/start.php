<?php
namespace Sirolad\app;

session_start();

require_once '../vendor/autoload.php';
require_once 'database.php';

use Slim\Slim;
use Illuminate\Database\Capsule\Manager as Capsule;

$app = new Slim(['view' => new \Slim\Views\Twig(),
    'debug' => true
 ]);

$app->db = function () {
    return new Capsule;
};

$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [new \Slim\Views\TwigExtension(), ];

require 'routes.php';
