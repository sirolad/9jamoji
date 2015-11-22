<?php

namespace Sirolad\app\base\controllers;

use Slim\Slim;
use Sirolad\app\base\models\Emoji;
use Sirolad\app\base\errors\Errors;
use Sirolad\app\base\controllers\UserController;

class EmojiController
{
    public static function createEmoji(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $emojis = Emoji::all();
        $name = $app->request->params(UserController::format('name'));
        $char = $app->request->params('char');
        $keywords = $app->request->params('keywords');
        $category = $app->request->params(UserController::format('category'));

        if (isset($name) && isset($char) && isset($keywords) && isset($category)) {
            $emoji = Emoji::create(array(
                'name'      => $name,
                'char'      => $char,
                'keywords'  => explode(",",$keywords),
                'category'  => $category,
                'created_by'=> 'you'
            ));

            return json_encode(['status' => 201, 'message' => 'Your emoji was successfully created.']);
        } else {
            return Errors::error401('Incomplete Input fields!');
        }
    }

    public static function getAll(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        echo Emoji::all();
    }

    public static function getOne(Slim $app, $id)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $selected = Emoji::where('id', $id)->first();
        if ($selected) {
            echo $selected;
        } else {
            return Errors::error401('The requested id does not exist');
        }
    }

    public static function deleteEmoji(Slim $app, $id)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $deleted = Emoji::destroy($id);
        if ($deleted) {
            $info = array(
                "status"  => 201,
                "message" => "Emoji .$id. has been deleted successfully!");
            return json_encode($info);
        } else {
            return Errors::error401('The requested id does not exist');
        }
    }
}