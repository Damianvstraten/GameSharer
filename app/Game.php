<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function owner() {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'game_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id');
    }

    public function ratings() {
        return $this->hasMany('App\Rating', 'game_id');
    }

    public function delete()
    {
        $this->comments()->delete();
        return parent::delete();
    }

    /**
     * Get average rating of the game
     *
     * @return string
     */
    public function getRating() {
        $ratings = $this->ratings();
        $averageRating = $ratings->avg('score');

        return number_format($averageRating, 1);
    }

    public function isRatedByUser($user_id) {
        $result = $this->ratings()->where('user_id', $user_id)->where('game_id', $this->id)->get();

        if(count($result) == 0) {
            return false;
        } else {
            return true;
        }
    }
}
