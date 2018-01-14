<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_games = Game::where('developer_id', Auth::id())->get();

        return view('games.index')->withUserGames($user_games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('games.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
        ));

        $game = new Game();

        $game->name = $request->name;
        $game->description = $request->description;
        $game->release_date = $request->release_date;
        $game->developer_id = Auth::id();
        $game->category_id = $request->category;

        $game->save();

        return redirect()->route('games.show', $game->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $game = Game::find($id);
        $comments = Comment::where('game_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('games.show')->with(array('game' => $game, 'comments' => $comments));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $game = Game::find($id);
        $categories = Category::orderBy('name')->get();

        return view('games.edit')->with(array('game' => $game, 'categories' => $categories));
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
        $this->validate($request, array(
            'name' => 'required',
            'description' => 'required',
            'release_date' => 'required|date',
        ));

        $game = Game::find($id);

        $game->name = $request->name;
        $game->description = $request->description;
        $game->release_date = $request->release_date;
        $game->category_id = $request->category;

        $game->save();

        return redirect()->route('games.show', $game->id);
    }

    /**
     *
     * Update the active state state in storage
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function state(Request $request, $id) {
            if($request->active_state == 'on') {
                $state = true;
            } else {
                $state = false;
            }

            $game = Game::find($id);
            $game->active = $state;

            $game->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);

        $game->delete();

        return redirect()->route('games.index');
    }
}
