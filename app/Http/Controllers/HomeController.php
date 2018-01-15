<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     */
    public function index()
    {
        $categories = Category::orderBy('name')->get();
        $games = Game::with('owner')->where('active', true)->get();

        return view('layouts.home')->with(array('games' => $games, 'categories' => $categories));
    }

    public function search() {
        $categories = Category::orderBy('name')->get();
        $q = Input::get('q');
        $games = '';

        switch (Input::get('filter')) {
            case "new":
                $games = $this->filterByNew($q);
                break;
            case "upcomming":
                $games = $this->filterByUpcomming($q);
                break;
            case "popular":
                $games = $this->filterByNew($q);
                break;
        }

        return view('layouts.home')->with(array('games' => $games, 'categories' => $categories));
    }

    public function filterByUpcomming($q)
    {
        $games = Game::where('name', 'LIKE', '%' . $q . '%')
            ->where('active', true)
            ->where('release_date', '>', date('Y/m/d'))
            ->orderBY('release_date', 'ASC')
            ->get();

        return $games;
    }

    public function filterByNew($q)
    {
        $games = Game::where('name', 'LIKE', '%' . $q . '%')
            ->where('active', true)
            ->where('release_date', '<=', date('Y/m/d'))
            ->get();

        return $games;
    }
}
