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

    /**
     *  The attributes that are mass assignable.
     * @var array
     * */
    protected $fillable = ['name','char','keyword','category','created_by'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('Sirolad\app\base\model\User');
    }
}
