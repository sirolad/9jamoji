<?php

use Sirolad\app\base\controllers\EmojiController;

$app->get('/emojis', function () use ($app){
    echo EmojiController::getAll($app);
});

$app->get('/emojis/:id', function ($id) use ($app){
    echo EmojiController::getOne($app,$id);
});

$app->post('/emojis', function () use ($app){
    echo EmojiController::createEmoji($app);
});

$app->delete('/emojis/:id', function ($id) use ($app){
    echo EmojiController::deleteEmoji($app, $id);
});

$app->put('/emojis/:id', function ($id) use ($app){
    echo EmojiController::updateEmoji($app, $id);
});

$app->patch('/emojis/:id', function ($id) use ($app){
    echo EmojiController::updateEmoji($app, $id);
});