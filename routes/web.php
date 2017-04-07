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
Route::get('/truyen/{manga}','MangaController@show')->name('manga');
Route::get('/truyen/{manga}/{chapter_slug}', 'MangaController@show')->name('manga.chapter');
Route::get('/doc-truyen-manga-mien-phi','IndexController@full')->name('manga.full');
Route::get('/term-of-service','IndexController@tos')->name('manga.tos');
Route::get('/privacy-policy','IndexController@priv')->name('manga.priv');
Route::get('/doc-truyen-mien-phi-moi-nhat','IndexController@latest_manga')->name('manga.latest');
Route::get('/doc-truyen-manhua-mien-phi-moi-nhat','IndexController@latest_manhua')->name('manhua.latest');
Route::get('/doc-truyen-manhwa-mien-phi-moi-nhat','IndexController@latest_manhwa')->name('manhwa.latest');
//Route::get('search/manga/{query}','SearchController@search');
Route::get('/tim-kiem','SearchController@search');
Route::get('/yeu-thich','UserController@favorites')->middleware('auth')->name('favorite');

//Auth
Route::get('/redirect/{provider}', 'SocialAuthController@redirect')->name('social.redirect');
Route::get('/callback/{provider}', 'SocialAuthController@callback');

//api fav
Route::get('/api/favorite/{manga}','AjaxController@toggleFavorite')->middleware('auth');
Route::post('/update-view/{manga}','AjaxController@updateView');

//genre
Route::get('/the-loai/{genre?}','GenreController@show')->name('genre');

//sitemap
Route::get('sitemap','SitemapController@sitemap');
//update chap
//Route::get('update-chap','UpdateChapController@getFromURL');
//Route::get('update-index','UpdateChapController@getFromIndex');
//Route::get('update-fox','UpdateChapController@getMangaFox');
//Route::get('uploadimg','UpdateChapController@uploadImg');
//Route::get('google','UpdateChapController@googleUpload');
//Route::get('get-reader','UpdateChapController@getMangaReader');
//Route::get('update-reader','UpdateChapController@getFromReaderIndex');
//Route::get('comicvn','UpdateChapController@getComicVN');
//Route::get('comicindex','UpdateChapController@getIndexComic');
Route::get('lien-he', 'IndexController@contact')->name('contact');
Route::get('test','TestController@index');

//up truyen

Route::get('up-truyen', 'MangaController@create')->name('manga.create')->middleware('auth');
Route::post('up-truyen', 'MangaController@store')->name('manga.store')->middleware('auth');
Route::get('yeu-cau-truyen','RequestMangaController@show')->name('request.show')->middleware('auth');
Route::post('yeu-cau-truyen','RequestMangaController@store')->name('request.store')->middleware('auth');

//blog

Route::get('/tin-tuc/{slug?}','PostController@show');

//anh che
Route::get('/meme-anh-che/{slug?}','MemeController@index')->name('meme.index');
Route::get('/tao-anh-che-truyen-tranh','MemeController@create')->name('meme.create');

Route::post('/tao-anh-che-truyen-tranh','MemeController@store')->middleware('auth');

//admin
Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware' =>'admin-check'],function (){
    Route::get('/','MemeController@index')->name('meme.admin.index');
    Route::get('/meme/check/{id}','MemeController@check')->name('meme.check');
    Route::get('/meme/uncheck/{id}','MemeController@uncheck')->name('meme.uncheck');
    Route::get('meme/delete/{id}','MemeController@delete')->name('meme.delete');
});
