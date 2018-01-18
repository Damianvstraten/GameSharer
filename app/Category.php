<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function game() {
        return $this->belongsToMany('App\Game', 'game_id');
    }
}
