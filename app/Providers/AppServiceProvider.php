<?php

namespace App\Providers;

use App\Chapter;
use App\Genre;
use App\Manga;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

//        Carbon::setLocale('vi');
//        Genre::saved(function($genres){
//            Cache::forget('allGenres');
//        });
//        Manga::saved(function($manga){
//            Cache::tags('genre')->forget($manga->getCacheKey());
//            Cache::tags('author')->forget($manga->getCacheKey());
//            Cache::tags('latest.chap')->forget($manga->getCacheKey());
//            Cache::tags('index')->flush();
//        });
//        $allGenres=Cache::rememberForever('allGenres',function(){
//            return Genre::all();
//        });
//        View::share( 'allGenres',$allGenres);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
