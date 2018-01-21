<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category', 'release_date',
    ];

    public function owner() {
        return $this->belongsTo('App\User', 'developer_id');
    }

    public function comments() {
        return $this->hasMany('App\Comment', 'game_id');
    }

    public function sub_comments() {
        return $this->hasMany('App\Comment', 'game_id');
    }

    public function category() {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }

    public function ratings() {
        return $this->hasMany('App\Rating', 'game_id');
    }

    /**
     * Filter on all, upcoming, new or best rated games
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeFilter($query, $filterOption)
    {
        if($filterOption != null) {
            switch ($filterOption) {
                case "new":
                    return $query->where('release_date', '<=', date('Y/m/d'))->orderBy('release_date', 'desc');
                case "upcoming":
                    return $query->where('release_date', '>', date('Y/m/d'))->orderBy('release_date', 'asc');
                case "rating":
                    return $query->orderBy('rating', 'desc');
            }
        }
    }

    /**
     * Get all active games
     *
     * @param $query
     * @return mixed
     */
    public function scopeAllActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Get all games based on the search
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'LIKE', '%' . $q . '%');
    }

    /**
     * Get all games filtered by category
     *
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeCategory($query, $category)
    {
        if($category != null) {
            return $query->where('category_id', $category);
        }
    }

    /**
     * Delete a game with relationships
     *
     * @return bool|null
     */
    public function delete()
    {
        $this->comments()->delete();
        $this->sub_comments()->delete();
        $this->ratings()->delete();
        return parent::delete();
    }

    /**
     * Get average rating of the game
     *
     * @return string
     */
    public function recalculateRating() {
        $ratings = $this->ratings();
        $averageRating = $ratings->avg('score');

        $this->rating = $averageRating;
        $this->save();;
    }

    /**
     * Check if user has already rated the game
     *
     * @param $user_id
     * @return bool
     */
    public function isRatedByUser($user_id) {
        $result = $this->ratings()->where('user_id', $user_id)->where('game_id', $this->id)->get();

        if(count($result) == 0) {
            return false;
        } else {
            return true;
        }
    }
}
