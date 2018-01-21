<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments() {
        return $this->hasMany('App\Comments', 'user_id');
    }

    public function sub_comments() {
        return $this->hasMany('App\Comments', 'user_id');
    }

    public function ratings() {
        return $this->hasMany('App\Rating', 'user_id');
    }

    public function games() {
        return $this->hasMany('App\Game', 'developer_id');
    }

    public function isAdmin()
    {
        return (\Auth::check() && $this->admin == true);
    }
}
