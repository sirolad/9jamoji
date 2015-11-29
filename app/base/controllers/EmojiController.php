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

        if (! isset($name)) {
            return Errors::error401('Insert a name');
        }

        if (! isset($char)) {
            return Errors::error401('Insert an emoji');
        }

        if (! isset($keywords)) {
            return Errors::error401('Insert keywords');
        }

        if (! isset($category)) {
            return Errors::error401('Insert a category');
        }

        $passcode = Authorize::authentication($app);
        if ($passcode) {
                $emoji = new Emoji;
                $emoji->name = $name;
                $emoji->char = $char;
                $emoji->keywords = $keywords;
                $emoji->category = $category;
                $emoji->created_by = Authorize::authentication($app);

                $emoji->save();

                return json_encode(['status' => 201, 'message' => 'Your emoji was successfully created.']);
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
        $result = Emoji::all();
        $processed = json_decode($result);
            foreach ( $processed as $key ) {
                $key->keywords = explode(", ", $key->keywords);
            }
            return json_encode($processed);
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

        $find = Emoji::find($id);
        if ($find) {
            $selected = Emoji::where('id', $id)->get();
            $processed = json_decode($selected);
            foreach ($processed as $key) {
                $key->keywords = explode(", ",$key->keywords);
            }

            return json_encode($processed);
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

        $passcode = Authorize::authentication($app);
        if ($passcode) {

            $deleted = Emoji::destroy($id);
            if ($deleted) {
                $info = [
                    "status"  => 201,
                    "message" => "Emoji $id has been deleted successfully!"
                ];
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

        $passcode = Authorize::authentication($app);
        if ($passcode) {
            $update = Emoji::find($id);

            if ($update) {
                $columns = $app->request->isPut() ? $app->request->put() : $app->request->patch();

                foreach ($columns as $key => $value) {
                    $update->$key = $value;
                }
                $update->updated_at = gmdate("Y-m-d H:i:s", time());
                $update->save();

                return json_encode(['status' => 201, 'message' => 'Emoji '.$id.' successfully updated!']);

            } else {
                    return Errors::error401("The requested id:$id does not exist");
            }
        }
    }
}