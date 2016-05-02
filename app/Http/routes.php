<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::model('playlist', 'App\Playlist');
Route::model('poll', 'App\Poll');
Route::model('playlist_video', 'App\PlaylistVideo');
Route::model('poll_playlist', 'App\PollPlaylist');

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/login/{provider}', 'Auth\AuthController@getSocialAuth');
    Route::get('/login/callback/{provider}', 'Auth\AuthController@getSocialAuthCallback');
    Route::get('public_poll/{poll}', 'HomeController@poll');
    Route::get('load_playlist/{playlist}', 'PlaylistController@loadPlaylist');
    Route::get('public_playlist/{playlist}', 'HomeController@playlist');
    Route::get('login_ajax', 'Auth\AuthController@ajaxLogin');
    Route::get('/search/preview/{id}', 'SearchController@preview');
    Route::post('/susbcribe', 'HomeController@subscribe');

    Route::group(['middleware' => 'auth'], function () {

      Route::get('/search', 'SearchController@index');
      Route::get('/search_keywords', 'SearchController@searchKeywords');
      Route::get('/results', 'SearchController@results');
      Route::post('/sort_selected', 'SearchController@sortSelected');
      Route::get('/results/more', 'SearchController@resultsMore');

      Route::post('/search/add_video', 'SearchController@add_video');
      Route::post('/search/selected/remove', 'SearchController@remove_video');
      Route::get('/search/load_selected', 'SearchController@getSelected');

      Route::get('/playlist', 'PlaylistController@index');
      Route::post('/playlist/create', 'PlaylistController@store');
      Route::get('/playlist/delete/{playlist}', 'PlaylistController@delete');
      Route::post('/playlist/delete', 'PlaylistController@destroy');
      Route::get('/playlist/edit/{playlist}', 'PlaylistController@edit');
  		Route::post('/playlist/edit', 'PlaylistController@update');
      Route::get('/playlist/successful/{playlist}', 'PlaylistController@successful');
      Route::post('/playlist/sort_item', 'PlaylistController@sortItem');

      Route::get('/playlist/video/{playlist_video}/delete', 'PlaylistVideoController@delete');
      Route::post('/playlist/video/delete', 'PlaylistVideoController@destroy');

      Route::get('/poll', 'PollController@index');
      Route::get('/poll/create', 'PollController@create');
      Route::post('/poll/create', 'PollController@store');
      Route::post('/poll/create_add', 'PollController@store_add');
      Route::get('/poll/successful/{poll}', 'PollController@successful');
      Route::get('/poll/delete/{poll}', 'PollController@delete');
      Route::post('/poll/delete', 'PollController@destroy');
      Route::get('/poll/edit/{poll}', 'PollController@edit');
  		Route::post('/poll/edit', 'PollController@update');
      Route::get('/poll/add/{playlist}', 'PollController@addPlaylist');
      Route::post('/poll/add', 'PollPlaylistController@store');
      Route::post('/poll/sort_item', 'PollController@sortItem');
      Route::post('/pollplaylist/{poll_playlist}/vote', 'PollPlaylistController@storeVote');

      Route::get('/poll/playlist/{poll_playlist}/delete', 'PollPlaylistController@delete');
      Route::post('/poll/playlist/delete', 'PollPlaylistController@destroy');

    });


    Route::get('/home', 'HomeController@index');
});
