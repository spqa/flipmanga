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
        //return Cache::get('index_page');
//        return Cache::remember('index_page',15,function (){
            $latestHotUpdate = Cache::tags('index')->rememberForever('latest.hot.update', function () {
                return Manga::orderBy('updated_at', 'desc')->orderBy('view', 'desc')->take(12)->get();
            });
            $newRelease = Cache::tags('index')->rememberForever('new.release', function () {
                return Manga::orderBy('created_at', 'desc')->take(12)->get();
            });
            $recommend = Cache::remember('manga.list.hour', 10, function () {
                $list = collect(Redis::zrevrange('manga.trending.hour', 0, 16))->map(function ($id) {
                    return Manga::find($id);
                });
                if ($list->count() < 6) {
                    Manga::orderBy('view', 'desc')->take(6)->get()->each(function ($item) use ($list) {
                        $list->push($item);
                    });
                }
                return $list->unique('id');
            });
//        dd(Redis::zrevrange('manga.trending',0,16));
            $latestUpdate = Cache::tags('index')->rememberForever('latest.update', function () {
                return Manga::orderBy('updated_at', 'desc')->take(12)->get();
            });
            $topToday = Cache::remember('manga.list.day', 15, function () {
                $list = collect(Redis::zrevrange('manga.trending.day', 0, 16))->map(function ($id) {
                    return Manga::find($id);
                });
                if ($list->count() < 6) {
                    Manga::orderBy('view', 'desc')->take(6)->get()->each(function ($item) use ($list) {
                        $list->push($item);
                    });
                }
                return $list->unique('id');
            });
//            return view('index', compact('latestHotUpdate', 'newRelease', 'recommend', 'latestUpdate', 'topToday'))->render();
            return view('index', compact('latestHotUpdate', 'newRelease', 'recommend', 'latestUpdate', 'topToday'));
//        });

    }

    public function full()
    {
        $title_page = 'Free full manga';
        $page_description = 'Read free full manga for free :D';
        $mangas = Manga::whereStatus('Finished')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manga()
    {
        $title_page = 'Free latest manga';
        $page_description = 'Read free latest manga for free :D';
        $mangas = Manga::orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manhwa()
    {
        $title_page = 'Free latest manhwa';
        $page_description = 'Manhwa (Hangul: 만화, Korean pronunciation: [manhwa]) is the general Korean term for comics and print cartoons (common usage also includes animated cartoons). Outside of Korea, the term usually refers specifically to South Korean comics. Read free latest manhwa for free :D';
        $mangas = Manga::inRandomOrder()->orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manhua()
    {
        $title_page = 'Free latest manhua';
        $page_description = ' Manhua (simplified Chinese: 漫画; traditional Chinese: 漫畫; pinyin: Mànhuà; Jyutping: maan6 waa2) are Chinese comics produced in Mainland China, Hong Kong, and Taiwan., read free latest manhua for free :D';
        $mangas = Manga::inRandomOrder()->orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }
}
