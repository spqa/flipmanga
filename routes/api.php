<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/genres/{genre?}','AjaxController@genre');
Route::get('/latest-update','AjaxController@latestUpdate');
Route::get('/manga-in-progress','AjaxController@getMangaProgress')->middleware('enc.cookie');
Route::post('/genre','AjaxController@genres');
Route::get('/genre/{id}','GenreController@getBySlug');
Route::get('/search/{query?}','SearchController@autocompleteSearch');


