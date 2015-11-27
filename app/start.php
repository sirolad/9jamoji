<?php
/*
 * Instantiation of Eloquent and Slim
 */


require_once '../vendor/autoload.php';
require_once 'database.php';

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Illuminate\Database\Capsule\Manager as Capsule;

$app = new Slim(['view' => new Twig(),
    'debug' => true
 ]);

$app->db = function () {
    return new Capsule;
};

$view = $app->view();
$view->setTemplatesDirectory('../app/views');
$view->parserExtensions = [new TwigExtension(), ];

