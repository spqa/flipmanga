<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Manga;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
    public function index()
    {
        //return Cache::get('index_page');
//        return Cache::remember('index_page',15,function (){
            $latestHotUpdate = Cache::tags('index')->rememberForever('latest.hot.update', function () {
                return Manga::orderBy('updated_at', 'desc')->orderBy('view', 'desc')->take(24)->get();
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
                return Manga::orderBy('updated_at', 'desc')->paginate(12);
            });
            $topToday = Cache::remember('manga.list.day', 15, function () {
                $list = collect(Redis::zrevrange('manga.trending.day', 0, 10))->map(function ($id) {
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
        $title_page = 'Truyện manga, manhwa, manhua full';
        $page_description = 'Đọc truyện tranh Nhật Bản, Trung Quốc, Hàn Quốc miễn phí';
        $mangas = Manga::whereStatus('Finished')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manga()
    {
        $title_page = 'Truyện mới cập nhật';
        $page_description = 'Danh sách truyện được cập nhật chapter mới nhất';
        $mangas = Manga::orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manhwa()
    {
        $title_page = 'Truyện manhwa - Truyện Hàn Quốc manhwa mới nhất';
        $page_description = 'Manhwa (Hangul: 만화, Korean phát âm: [manhwa]) Manhwa là thể loại truyện tranh của Hàn Quốc có sức ảnh hưởng lớn từ Manga Nhật Bản. Ngoài ra Manhwa cũng là thuật ngữ dùng cho tranh biếm họa hài hước và bản in. Tuy nhiên, tại Việt Nam, từ "manhwa" chỉ được dùng với nghĩa truyện tranh Hàn Quốc.';
        $mangas = Genre::whereSlug('manhwa')->firstOrFail()->mangas()->orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function latest_manhua()
    {
        $title_page = 'Truyện manhua - Truyện tranh Trung Quốc mới nhất';
        $page_description = ' Manhua (simplified Chinese: 漫画; traditional Chinese: 漫畫; pinyin: Mànhuà; Jyutping: maan6 waa2) Thể loại truyện Manhua là các bộ truyện tranh của Trung Quốc, HongKong hoặc Đài Loan . :D';
        $mangas = Genre::whereSlug('manhua')->firstOrFail()->mangas()->orderBy('updated_at', 'desc')->paginate(24);
        return view('manga.manga_list_custom', compact('mangas', 'title_page', 'page_description'));
    }

    public function tos(){
        return view('tos');
    }

    public function priv(){
        return view('priv');
    }

    public function contact()
    {
        return view('contact');
    }
}
