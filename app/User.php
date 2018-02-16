<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    function posts() {
        return $this->hasMany('App\Post');
    }

    protected $fillable = [
        'name', 'email', 'password', 'birth', 'image',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    function friendshipA()
    {
        return $this->hasMany('App\User', 'Friendship');
    }
    
    function friendshipB()
    {
        return $this->belongsToMany('App\User', 'Friendship');
    }
}
