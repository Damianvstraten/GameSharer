<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score'
    ];

    public function owner() {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function game() {
        return $this->belongsTo('App\Game', 'game_id');
    }
}
