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

// Auth
Route::match(['put','patch'], 'games/{game}/state', 'GameController@state')->name('games.state')->middleware('auth');
Route::resource('games', 'GameController', ['except' => [
    'show'
]])->middleware('auth');

Route::resource('games', 'GameController', ['only' => [
    'show'
]]);

Route::resource('comments', 'CommentController', ['only' => [
    'store'
]])->middleware('auth');

Route::resource('ratings', 'RatingController', ['only' => [
    'store'
]])->middleware('auth');

Route::resource('subcomments', 'SubCommentController',  ['only' => [
    'store'
]])->middleware('auth');

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/search', 'HomeController@search')->name('search');
Route::get('/home', 'HomeController@index')->name('home');
