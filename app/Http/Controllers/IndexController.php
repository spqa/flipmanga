<?php

namespace App\Http\Controllers;

use App\Manga;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index()
    {
        $latestHotUpdate=Manga::orderBy('updated_at','desc')->orderBy('view','desc')->take(12)->get();
        $newRelease=Manga::orderBy('created_at','desc')->take(12)->get();
        $recommend = Cache::remember('manga.list.hour',10,function (){
            $list=collect(Redis::zrevrange('manga.trending.hour',0,16))->map(function ($id){
                return Manga::find($id);
            });
            if ($list->count()<6){
                Manga::orderBy('view','desc')->take(6)->get()->each(function ($item)use($list){
                    $list->push($item);
                });
            }
            return $list->unique('id');
        });
//        dd(Redis::zrevrange('manga.trending',0,16));
        $latestUpdate=Manga::orderBy('updated_at','desc')->take(12)->get();
        $topToday=Cache::remember('manga.list.day',15,function (){
            $list=collect(Redis::zrevrange('manga.trending.day',0,16))->map(function ($id){
                return Manga::find($id);
            });
            if ($list->count()<6){
                Manga::orderBy('view','desc')->take(6)->get()->each(function ($item)use($list){
                    $list->push($item);
                });
            }
            return $list->unique('id');
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
