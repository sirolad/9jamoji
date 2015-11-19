<?php
namespace Sirolad\app\base\controllers;

use Slim\Slim;
use Firebase\JWT\JWT;
use Sirolad\app\base\Config;
use Sirolad\app\base\models\User;
use Sirolad\app\base\errors\Errors;

class UserController
{
    public static function format($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public static function register(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');
        $username = $app->request->params(self::format('username'));
        $password = $app->request->params(self::format('password'));
        $cpassword = $app->request->params(self::format('password_confirm'));

        if ($username && $password && $cpassword) {
            if (strlen($password) > 4) {
                if ($password == $cpassword) {
                    $user = new User();
                    $user = User::firstOrCreate(array('username' => $username, 'password' => sha1($password)));
                    return json_encode(['status' => 201, 'username' => $username, 'message' => 'Created! Login to get a token.']);
                }
                else {
                    $app->halt(400, json_encode(['status' => 400, 'message' => 'Password does not match!']));
                }
            }
            else {
                $app->halt(400, json_encode(['status' => 400, 'message' => 'Password is too short!']));
            }
        }
        else {
            $app->halt(400, json_encode(['status' => 400, 'message' => 'Incomplete entry is not allowed!']));
        }
    }

    public static function login(Slim $app)
    {
        $app->response->headers->set('Content-Type', 'application/json');

        $username = $app->request->params(self::format('username'));
        $password = $app->request->params(self::format('password'));

        if (!isset($username)) {
            return Errors::error401("Username is not supplied!");
        }

        if (!isset($password)) {
            return Errors::error401("Password is not supplied");
        }

        $authUser = User::where('username', $username)->first();
        if (empty($authUser)) {
            return Errors::error401('This User is Not Found!');
        }
        elseif ($authUser['password'] !== sha1($password)) {
            return Errors::error401('Invalid Credentials');
        }
        else {

            $config = new Config();
            $config::loadenv();

            $key = getenv('jwt_key');
            $algorithm = getenv('jwt_algorithm');
            $issued_at = $_SERVER['REQUEST_TIME'];
            $expires = time() + 3600;
            $token = array("issued" => getenv('jwt_issued_at'), "issuer" => getenv('jwt_issuer'), "not_before" => getenv('jwt_not_before'), "user" => $authUser['username']);

            $jwt = JWT::encode($token, $key, $algorithm);

            $success = array("status" => 200, "token" => $jwt, "issued at" => gmdate("Y-m-d H:i:s",$issued_at), "expires at" => gmdate("Y-m-d H:i:s",$expires), "token for" => $authUser['username']);

            return json_encode($success);
        }
    }
}
