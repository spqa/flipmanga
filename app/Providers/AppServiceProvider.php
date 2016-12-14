<?php

namespace App\Providers;

use App\Genre;
use App\Manga;
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
        Genre::saved(function($genres){
            Cache::forget('allGenres');
        });
        Manga::saved(function($manga){
            Cache::tags('genre')->forget($manga->getCacheKey());
            Cache::tags('author')->forget($manga->getCacheKey());
        });
        $allGenres=Cache::rememberForever('allGenres',function(){
            return Genre::all();
        });
        View::share( 'allGenres',$allGenres);
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
