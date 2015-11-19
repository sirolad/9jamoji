<?php

namespace Sirolad\app\base\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get the emojiss for the users.
     */
    public function emojis()
    {
        return $this->hasMany('Emoji');
    }

    /**
     *  The attributes that are mass assignable.
     * @var array
     * */
    protected $fillable = ['username','password'];
}
