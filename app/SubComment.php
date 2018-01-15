<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body'
    ];

    public function owner() {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function comment() {
        return $this->belongsTo('App\Comment,', 'main_comment_id');
    }
}
