<?php
/**
 * This class handles authorization using JWT decode method
 *
 * @package Sirolad\app\base\controllers\EmojiController
 * @author  Surajudeen Akande <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 */

namespace Sirolad\app\base\middleware;

use Slim\Slim;
use Exception;
use Firebase\JWT\JWT;
use Sirolad\app\base\Config;
use Sirolad\app\base\models\User;
use Sirolad\app\base\errors\Errors;

class Authorize
{
    /**
     * Returns a JSON error output
     *
     * @param Instance of Slim
     * @return string
     */
    public static function authentication(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        $token = $app->request->headers->get('Authorization');

        Config::loadenv();
        $key = getenv('jwt_key');
        $algorithm = array('HS256');

        if (!$token) {
            $app->halt(401, json_encode(['status' => 401, 'message' => 'You need a token to perform this action!']));
        }

        try {
            $decode_jwt = JWT::decode($token,$key,$algorithm);
        } catch (Exception $e) {
            $app->halt(400, json_encode(['status' => 400, 'message' => 'The token supplied is invalid!.']));
        }

        return $decode_jwt->user;
    }
}