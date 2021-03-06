<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    public function game() {
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function owner() {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function subcomments(){
        return $this->hasMany('App\SubComment', 'main_comment_id');
    }
}
