<?php

namespace App\Http\Controllers;

use App\Comment;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestD
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'main_comment' => 'required',
        ));

        $comment = new Comment();

        $comment->body = $request->main_comment;
        $comment->developer_id = Auth::id();
        $comment->game_id = $request->game_id;

        $comment->save();

        Session::flash('succes_comment','Your comment is successfully posted!');

        return back();
    }
}
