<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @param Request $request
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('name')->get();
        $games = Game::with(['owner', 'category', 'ratings'])
            ->allActive()
            ->search($request->search)
            ->filter($request->filter)
            ->category($request->category)
            ->get();

        $request->flash();

        return view('layouts.home')->with(array('games' => $games, 'categories' => $categories));
    }
}
