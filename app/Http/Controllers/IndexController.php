<?php

namespace App\Http\Controllers;

use App\Manga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    public function index()
    {
        $latestHotUpdate=Manga::take(12)->get();
        $newRelease=Manga::orderBy('created_at','desc')->take(12)->get();
        $recommend=Manga::inRandomOrder()->take(12)->get();
        $latestUpdate=Manga::orderBy('updated_at','desc')->take(12)->get();
        $topToday=Cache::rememberForever(Carbon::today(),function (){
            return Manga::orderBy('view')->take(10)->get();
        });
        return view('index',compact('latestHotUpdate','newRelease','recommend','latestUpdate','topToday'));
    }

    public function full(){
        $title_page='Free full manga';
        $page_description='Read free full manga for free :D';
        $mangas=Manga::whereStatus('Finished')->paginate(24);
        return view('manga.manga_list_custom',compact('mangas','title_page','page_description'));
    }

    public function latest(){
        $title_page='Free latest manga';
        $page_description='Read free latest manga for free :D';
        $mangas=Manga::orderBy('updated_at','desc')->paginate(24);
        return view('manga.manga_list_custom',compact('mangas','title_page','page_description'));
    }
}
