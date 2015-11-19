<?php

use Sirolad\app\base\models\User;

$app->get('/users/:username', function ($username) use ($app) {
    // $emoj = $app->db->table('emojis')->where('name', $name)->first();
    // var_dump($emoj);
    $user = User::where('username', $username)->first();
    var_dump($user['username']);
});
