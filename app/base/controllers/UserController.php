<?php
/**
 * This class holds a set of background controller methods for users' accounts management.
 * @package Sirolad\app\base\controllers\EmojiController
 * @author  Surajudeen Akande <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 */
namespace Sirolad\app\base\controllers;

use Slim\Slim;
use Firebase\JWT\JWT;
use Sirolad\app\base\Config;
use Sirolad\app\base\models\User;
use Sirolad\app\base\errors\Errors;
use Sirolad\app\base\middleware\Authorize;

class UserController
{
    /**
     * Sanitize Input
     *
     * @param string Input
     * @return string
     */
    public static function format($data)
    {
        return trim(stripslashes(htmlspecialchars($data)));
    }

    /**
     * Create a user account
     *
     * @param Slim $app
     * @return string
     */
    public static function register(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        $username = $app->request->params(self::format('username'));
        $password = $app->request->params(self::format('password'));

        $user = User::firstOrCreate([
            'username' => $username,
            'password' => sha1($password)
        ]);

        return json_encode([
            'status' => 201,
            'username' => $username,
            'message' => 'Created! Login to get a token.'
        ]);
    }

    /**
     * Login method which returns token
     *
     * @param Slim $app
     * @return string
     */
    public static function login(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        $username = $app->request->params(self::format('username'));
        $password = $app->request->params(self::format('password'));

        if (!isset($username, $password)) {
            $app->halt(401, json_encode(["status" => 401, "message" => "Username & Password Required!"]));
        }

        $authUser = User::where('username', $username)->first();
        if (empty($authUser)) {
            return Errors::error401('This User is Not Found!');
        }
        elseif ($authUser['password'] !== sha1($password)) {
            return Errors::error401('Invalid Credentials');
        }
        else {
           return self::Tokenize($app);
        }
    }

    /**
     * Generates Token which expires in One hour
     * @param Slim $app
     */
    public static function Tokenize(Slim $app)
    {
        $username = $app->request->params(self::format('username'));

        Config::loadenv();

        $key = getenv('jwt_key');
        $token = [
            "issued" => getenv('jwt_issued_at'),
            "issuer" => getenv('jwt_issuer'),
            "user" => $username,
            "exp" => time() + 31556926
        ];
        $jwt = JWT::encode($token, $key);
        $success = [
            "status" => 200,
            "token" => $jwt,
            "issued at" => gmdate("Y-m-d H:i:s", time()),
            "expires at" => gmdate("Y-m-d H:i:s", time() + 3600),
            "token for" => $username
            ];

        return json_encode($success);
    }

    /**
     * Logs out an authenticated user only
     *
     * @param Slim $app
     * @return string
     */
    public static function logout(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $passcode = Authorize::authentication($app);
        if ($passcode) {
            $success = [
                "status" => 200,
                "message" => "You have been successfully logged out!"
            ];

            return json_encode($success);
        }
    }
}
