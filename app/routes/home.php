<?php
/*
 * Routes for landing page
 */
$app->get('/', function () use ($app) {
    $app->render('home.php');
});
