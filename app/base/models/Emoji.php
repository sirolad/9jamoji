<?php

namespace Sirolad\app\base\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Emoji extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'emojis';
}
