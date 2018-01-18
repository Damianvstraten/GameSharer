<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
           'score' => 'required|integer'
        ));
        $rating = new Rating();

        $rating->score = $request->score;
        $rating->user_id = Auth::id();
        $rating->game_id = $request->game_id;

        $rating->save();

        Session::flash('success_rating','Thanks for rating this game!');

        return back();
    }
}
