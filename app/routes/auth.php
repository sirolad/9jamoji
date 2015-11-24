<?php

use Sirolad\app\base\controllers\UserController;

$app->get('/register', function () use ($app) {
    $app->render('register.php');
});

$app->post('/register', function () use ($app) {
    echo UserController::register($app);
});

/*
| login
*/
$app->post('/auth/login', function () use ($app){
    echo UserController::login($app);
});

/*
| logout
*/
$app->get('/auth/logout', function () use ($app){
    echo UserController::logout($app);
});