<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    function comments() 
    {
        return $this->hasMany('App\Comment');
    }
    
    function user()
    {
        return $this->belongsTo('App\User');
    }
    
    function accesslevel()
    {
        return $this->belongsTo('App\Accesslevel');
    }
}
