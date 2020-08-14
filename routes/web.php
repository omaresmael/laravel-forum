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

use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/threads', 'ThreadController@index');
Route::get('/threads/create', 'ThreadController@create');
Route::post('/threads', 'ThreadController@store')->middleware('auth');
Route::get('/threads/{channel}', 'ThreadController@index');
Route::get('/threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('/threads/{channel}/{thread}', 'ThreadController@destroy');
//Route::resource('threads','threadController');
Route::post('/threads/{thread}/replies', 'replyController@store');
Route::delete('/reply/{reply}/{thread}', 'ReplyController@destroy');

Route::post('/replies/{reply}/favorites','FavoritesController@store');
Route::delete('/replies/{reply}/favorites','FavoritesController@destroy');

Route::patch('/reply/{reply}', 'ReplyController@update');


Route::get('/profile/{user}', 'ProfileController@show');





