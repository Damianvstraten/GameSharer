<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category', 'release_date'
    ];

    public function owner() {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'game_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id');
    }

    public function delete()
    {
        $this->comments()->delete();
        return parent::delete();
    }
}
