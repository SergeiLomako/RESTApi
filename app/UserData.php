<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UserData extends Eloquent
{
    protected $connection = 'mongodb';

    protected $collection = 'users_data';

    protected $fillable = ['data', 'key'];

    protected $guarded = ['lastChange'];

    public function user(){
        return $this->belongsTo('App\User', 'key', '_id');
    }
}
