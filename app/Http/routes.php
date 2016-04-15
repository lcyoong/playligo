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

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/login/{provider}', 'Auth\AuthController@getSocialAuth');
    Route::get('/login/callback/{provider}', 'Auth\AuthController@getSocialAuthCallback');
    Route::get('/search', 'SearchController@index');
    Route::get('/search_keywords', 'SearchController@searchKeywords');
    // Route::post('/search', 'SearchController@searchKeywords');

    Route::get('/results', 'SearchController@results');
    Route::post('/sort_selected', 'SearchController@sortSelected');
    Route::get('/results/more', 'SearchController@resultsMore');
    // Route::post('/results', 'SearchController@fetchResults');


    Route::get('/search/preview/{id}', 'SearchController@preview');
    Route::post('/search/add_video', 'SearchController@add_video');
    Route::post('/search/selected/remove', 'SearchController@remove_video');
    Route::get('/search/load_selected', 'SearchController@getSelected');

    Route::get('/playlist', 'PlaylistController@index');
    Route::post('/playlist/create', 'PlaylistController@store');
    Route::get('/playlist/delete/{playlist}', 'PlaylistController@delete');
    Route::post('/playlist/delete', 'PlaylistController@destroy');
    Route::get('/playlist/edit/{playlist}', 'PlaylistController@edit');
		Route::post('/playlist/edit', 'PlaylistController@update');
    Route::get('/playlist/successful/{platlist}', 'PlaylistController@successful');
    Route::post('/playlist/sort_item', 'PlaylistController@sortItem');

    Route::get('/home', 'HomeController@index');
});
