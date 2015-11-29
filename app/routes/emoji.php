<?php
/*
 * Routes for emoji actions
 */

use Sirolad\app\base\controllers\EmojiController;

/**
 * Route to get all available emojis
 */
$app->get('/emojis', function () use ($app){
    echo EmojiController::getAll($app);
});

/**
 * Route to get one emoji resource
 */
$app->get('/emojis/:id', function ($id) use ($app){
    echo EmojiController::getOne($app,$id);
});

/**
 * Route to create an emoji
 */
$app->post('/emojis', function () use ($app){
    echo EmojiController::createEmoji($app);
});

/**
 * Route to delete an emoji
 */
$app->delete('/emojis/:id', function ($id) use ($app){
    echo EmojiController::deleteEmoji($app, $id);
});

/**
 * Route to Update an emoji
 */
$app->put('/emojis/:id', function ($id) use ($app){
    echo EmojiController::updateEmoji($app, $id);
});

/**
 * Route to partially update an emoji
 */
$app->patch('/emojis/:id', function ($id) use ($app){
    echo EmojiController::updateEmoji($app, $id);
});