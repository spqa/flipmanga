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
Route::get('/manga-in-progress','AjaxController@getMangaProgress')->middleware('enc.cookie');
Route::post('/genre','AjaxController@genres');

