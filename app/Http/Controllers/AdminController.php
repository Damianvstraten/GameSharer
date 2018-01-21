<?php

namespace App\Http\Controllers;

use App\Category;
use App\Game;
use App\User;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    public function index() {

        $games = Game::with('owner')->paginate(10);
        $users = User::with('games')
            ->orderBy('admin', true)
            ->orderBy('name', 'asc')
            ->paginate(10);

        $categories = Category::with('games')->orderBy('name', 'asc')->get();

        return view('admin.admin_panel')->with(array(
            'games' => $games,
            'users' => $users,
            'categories' => $categories));
    }

    public function storeCategory(Request $request) {
        $this->validate($request, array(
            'category_name' => 'required|max:120',
        ));

        $category = new Category();
        $category->name = $request->category_name;
        $category->save();

        Session::flash('category_added',' "' . $category->name .  '" added');

        return redirect()->route('admin');
    }

    public function switchAdmin(Request $request, $id) {
        if($request->active_state == 'on') {
            $state = true;
        } else {
            $state = false;
        }

        $user = User::find($id);

        $user->admin = $state;
        $user->save();

        return redirect()->route('admin');
    }
}
