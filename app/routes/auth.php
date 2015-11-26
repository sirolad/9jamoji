<?php
/*
 * Routes for authentication
 */

use Sirolad\app\base\controllers\UserController;

/*
 * Get register page
 */
$app->get('/register', function () use ($app) {
    $app->render('register.php');
});

/*
 * Post to register page
 */
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