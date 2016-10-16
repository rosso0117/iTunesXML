<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'Controller@index');

Auth::routes();


//songs
Route::resource('playlists', 'PlaylistsController');
Route::resource('playlists.songs', 'SongsController');
Route::resource('playlists.songs.reviews', 'ReviewsController');
Route::post('reviews/store', [
    'uses' => 'ReviewsController@store',
    'as'   => 'reviews.store'
]);
