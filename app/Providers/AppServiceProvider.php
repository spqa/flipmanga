<?php

namespace App\Providers;

use App\Genre;
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
