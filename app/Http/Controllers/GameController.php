<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('games.create');
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

        return view('games.show')->withGame($game);
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

        return view('games.edit')->withGame($game);
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

        $game->save();

        return redirect()->route('games.show', $game->id);
    }

    /**
     *
     * Update the active state state in storage
     *
     * @param Request $request
     * @param $id
     */
    public function active(Request $request, $id) {

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
