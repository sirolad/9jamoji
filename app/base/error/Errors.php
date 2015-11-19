<?php

namespace Sirolad\app\base\errors;
/**
*
*/
class Errors
{
    public static function error401($message)
    {
        $error = array(
            "status"  => 401,
            "message" => $message
        );

        return json_encode($error);
    }
}