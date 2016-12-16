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
Route::get('/free-full-mangas-online','IndexController@full')->name('manga.full');
Route::get('/read-free-latest-mangas-online','IndexController@latest')->name('manga.latest');
Route::get('/read-free-latest-mangas-online','IndexController@latest_manga')->name('manga.latest');
Route::get('/read-free-latest-manhua-online','IndexController@latest_manhua')->name('manhua.latest');
Route::get('/read-free-latest-manhwa-online','IndexController@latest_manhwa')->name('manhwa.latest');
//Route::get('search/manga/{query}','SearchController@search');
Route::get('/search','SearchController@search');
Route::get('/favorite','UserController@favorites')->middleware('auth')->name('favorite');

//Auth
Route::get('/redirect/{provider}', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

//api fav
Route::get('/api/favorite/{manga}','AjaxController@toggleFavorite')->middleware('auth');
Route::post('/update-view/{manga}','AjaxController@updateView');

//genre
Route::get('/genre/{genre?}','GenreController@show')->name('genre');

//sitemap
Route::get('sitemap','SitemapController@sitemap');
//update chap
Route::get('update-chap','UpdateChapController@index');
Route::get('test','TestController@index');


