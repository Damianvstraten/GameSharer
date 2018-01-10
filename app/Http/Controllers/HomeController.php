<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();

        return view('layouts.home')->withGames($games);
    }

    public function search() {
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

        return view('layouts.home')->withGames($games);
    }

    public function filterByUpcomming($q)
    {
        $games = Game::where('name', 'LIKE', '%' . $q . '%')
            ->where('release_date', '>', date('Y/m/d'))
            ->orderBY('release_date', 'ASC')
            ->get();

        return $games;
    }

    public function filterByNew($q)
    {
        $games = Game::where('name', 'LIKE', '%' . $q . '%')
            ->where('release_date', '<=', date('Y/m/d'))
            ->get();

        return $games;
    }
}
