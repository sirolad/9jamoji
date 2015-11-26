<?php
/**
 * This class handles unauthoriztion error.
 *
 * @package Sirolad\app\base\controllers\EmojiController
 * @author  Surajudeen Akande <surajudeen.akande@andela.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 * @link http://www.github.com/andela-sakande
 */
namespace Sirolad\app\base\errors;
/**
*
*/
class Errors
{
    /**
     * Returns a JSON error output
     *
     * @param string
     * @return string
     */
    public static function error401($message)
    {
        $error = array(
            "status"  => 401,
            "message" => $message
        );

        return json_encode($error);
    }
}