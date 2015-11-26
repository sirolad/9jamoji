<?php
/**
 * This class holds a set of background controller methods for emoji management.
 *
 * @package Sirolad\app\base\controllers\EmojiController
 * @author  Surajudeen Akande <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 */

namespace Sirolad\app\base\controllers;

use Slim\Slim;
use Sirolad\app\base\models\Emoji;
use Sirolad\app\base\errors\Errors;
use Sirolad\app\base\middleware\Authorize;
use Sirolad\app\base\controllers\UserController;

class EmojiController
{
    /**
     * Create an emoji resource
     *
     * @param Slim $app
     * @return string
     */
    public static function createEmoji(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $name = $app->request->params(UserController::format('name'));
        $char = $app->request->params('char');
        $keywords = $app->request->params('keywords');
        $category = $app->request->params(UserController::format('category'));

        $token = $app->request->headers->get('Authorization');

        if (! $token) {
            $app->halt(503, json_encode(['status' => 400, 'message' => 'Login to get a token!']));
        }

        $passcode = Authorize::authentication($app);
        if ($passcode) {
            if (isset($name) && isset($char) && isset($keywords) && isset($category)) {
                $emoji = new Emoji;
                $emoji->name = $name;
                $emoji->char = $char;
                $emoji->keywords = $keywords;
                $emoji->category = $category;
                $emoji->created_by = Authorize::authentication($app);

                $emoji->save();

                return json_encode(['status' => 201, 'message' => 'Your emoji was successfully created.']);
            } else {
                return Errors::error401('Incomplete Input fields!');
            }
        }
    }

    /**
     * Retrieve all available emoji resource
     *
     * @param Slim $app
     * @return string
     */
    public static function getAll(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        echo Emoji::all();
    }

    /**
     * Retrieve an emoji resource
     *
     * @param int $id ID of an emoji
     * @param Slim $app
     * @return string
     */
    public static function getOne(Slim $app, $id)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $selected = Emoji::where('id', $id)->first();
        if ($selected) {
            echo $selected;
        } else {
            return Errors::error401("The requested id:$id does not exist");
        }
    }

    /**
     * Destroy an emoji resource
     *
     * @param int $id ID of emoji
     * @param Slim $app
     * @return string
     */
    public static function deleteEmoji(Slim $app, $id)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $token = $app->request->headers->get('Authorization');

        if (! $token) {
            $app->halt(503, json_encode(['status' => 400, 'message' => 'Login to get a token!']));
        }

        $passcode = Authorize::authentication($app);
        if ($passcode) {

            $deleted = Emoji::destroy($id);
            if ($deleted) {
                $info = array(
                    "status"  => 201,
                    "message" => "Emoji $id has been deleted successfully!");
                return json_encode($info);
            } else {
                return Errors::error401("The requested id:$id does not exist");
            }
        }
    }

    /**
     * Update an emoji resource
     *
     * @param int $id ID of emoji to be updated
     * @param Slim $app
     * @return string
     */
    public static function updateEmoji(Slim $app, $id)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        $token = $app->request->headers->get('Authorization');
        if (! $token) {
            $app->halt(503, json_encode(['status' => 400, 'message' => 'Login to get a token!']));
        }

        $passcode = Authorize::authentication($app);
        if ($passcode) {
            $update = Emoji::find($id);

            if ($update) {
                $columns = $app->request->isPut() ? $app->request->put() : $app->request->patch();

                foreach ($columns as $key => $value) {
                    $update->$key = $value;
                }

                $update->save();

                return json_encode(['status' => 201, 'message' => 'Emoji '.$id.' successfully updated!']);

            } else {
                    return Errors::error401("The requested id:$id does not exist");
            }
        }
    }
}