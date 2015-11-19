<?php

use Sirolad\app\base\controllers\UserController;

//$userController = new UserController($app);

$app->get('/register', function () use ($app) {
    $app->render('register.php');
});

$app->post('/register', function () use ($app) {
    // $userController->register();
    echo UserController::register($app);
});

/*
| login
*/
$app->post('/auth/login', function () use ($app){
    echo UserController::login($app);
});
