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

Route::get('/','IndexController@index')->name('home');

Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('/manga/{manga}/{chapter?}','MangaController@show')->name('manga');
Route::get('/genre/{genre?}','GenreController@show')->name('genre');
Route::get('/free-full-mangas-online','IndexController@full')->name('manga.full');
Route::get('/read-free-latest-mangas-online','IndexController@latest')->name('manga.latest');
//Route::get('search/manga/{query}','SearchController@search');