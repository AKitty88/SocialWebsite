<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accesslevel extends Model
{
    function post() 
    {
        return $this->belongsTo('App\Post');
    }
}
