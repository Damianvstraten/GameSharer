<?php

namespace App\Http\Controllers;

use App\SubComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class SubCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'sub_comment' => 'required',
        ));

        $comment = new SubComment();

        $comment->body = $request->sub_comment;
        $comment->developer_id = Auth::id();
        $comment->game_id = $request->game_id;
        $comment->main_comment_id = $request->main_comment_id;

        $comment->save();

        Session::flash('succes_comment','Your comment is successfully posted!');

        return back();
    }
}
