<?php

use Sirolad\app\base\models\User;

$app->get('/users/:username', function ($username) use ($app) {
    $user = User::where('username', $username)->first();
    echo $user;
});

$app->get('/users', function() {
    $users = User::all();
    echo json_encode($users);
});
