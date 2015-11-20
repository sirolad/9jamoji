<?php

use Sirolad\app\base\controllers\EmojiController;

$app->get('/emojis', function () use ($app){
    echo EmojiController::getAll($app);
});

$app->post('/emojis', function () use ($app){
    echo EmojiController::createEmoji($app);
});