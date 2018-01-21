<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// User
Route::middleware('auth')->group(function () {
    Route::match(['put','patch'], 'games/{game}/state', 'GameController@state')->name('games.state');
    Route::resource('comments', 'CommentController', ['only' => ['store']]);
    Route::resource('ratings', 'RatingController', ['only' => ['store']]);
    Route::resource('subcomments', 'SubCommentController',  ['only' => ['store']]);
    Route::resource('games', 'GameController', ['except' => ['show']]);
});

// Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin', 'AdminController@index')->name('admin');
    Route::post('admin', 'AdminController@storeCategory')->name('store.category');
    Route::match(['put', 'patch'], 'admin/{user}/state', 'AdminController@switchAdmin')->name('user.update');
});

// No auth
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('games/{game}', 'GameController@show')->name('games.show');


Route::get('/', function () {
    return redirect('home');
});