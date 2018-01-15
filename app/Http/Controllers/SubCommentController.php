<?php

namespace App\Http\Controllers;

use App\SubComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubCommentController extends Controller
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
            'body' => 'required',
        ));

        $comment = new SubComment();

        $comment->body = $request->body;
        $comment->developer_id = Auth::id();
        $comment->game_id = $request->game_id;
        $comment->main_comment_id = $request->main_comment_id;

        $comment->save();

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
