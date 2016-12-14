<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Genre;
use App\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class AjaxController extends Controller
{
    public function genre($genre = null)
    {
        if ($genre == null) {
            return '';
        }
        if ($genre == 'random') {
            $mangas = Manga::inRandomOrder()->take(12)->get();
//            dd($mangas);
            $temp = function ($array) {
                $genres = '';
                foreach ($array->getCachedGenres() as $item) {
                    $genres .= '<div class="chip small-tag">' . $item->name . '</div>';
                }
                $authors = '';
                foreach ($array->getCachedAuthors() as $item) {
                    $authors .= '<a href="">' . $item->name . '</a>';
                }
                return '<a class="black-text" href="' . route('manga', ['manga' => $array->slug]) . '" rel="contents">
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <img class="manga-poster" src="' . $array->poster . '" />
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3">' . $array->name . '</h3>
                <span class="truncate">' . $genres . '
                      </span>
                <p class="padding-0 margin-0">Chap: ' . $array->getCacheLatestChap() . '</p>
                <p class="truncate padding-0 margin-0">Author: ' . $authors . '</p>
                <p class="padding-0 margin-0">View :' . $array->view . '</p>
                <span class="badge green white-text past-timer">' . $array->updated_at->diffForHumans() . '</span>
            </div>
        </div>
    </div>
</div>
</a>';
            };
            $text = '';
            foreach ($mangas as $manga) {
                $text .= $temp($manga);
            }
            return $text;
        }
        return Cache::remember('genre:' . $genre, 30, function ()use($genre) {
            $mangas = Genre::whereSlug($genre)->first()->mangas()->orderBy('updated_at','desc')->take(12)->get();
//            $mangas = Manga::orderBy('updated_at', 'desc')->select(['poster', 'slug', 'updated_at', 'name'])->take(12)->get();
//            dd($mangas);
            $temp = function ($array) {
                $genres = '';
                foreach ($array->getCachedGenres() as $item) {
                    $genres .= '<div class="chip small-tag">' . $item->name . '</div>';
                }
                $authors = '';
                foreach ($array->getCachedAuthors() as $item) {
                    $authors .= '<a href="">' . $item->name . '</a>';
                }
                return '<a class="black-text" href="' . route('manga', ['manga' => $array->slug]) . '" rel="contents">
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <img class="manga-poster" src="' . $array->poster . '" />
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3">' . $array->name . '</h3>
                <span class="truncate">' . $genres . '
                      </span>
                <p class="padding-0 margin-0">Chap: ' . $array->getCacheLatestChap() . '</p>
                <p class="truncate padding-0 margin-0">Author: ' . $authors . '</p>
                <p class="padding-0 margin-0">View :' . $array->view . '</p>
                <span class="badge green white-text past-timer">' . $array->updated_at->diffForHumans() . '</span>
            </div>
        </div>
    </div>
</div>
</a>';
            };
            $text = '';
            foreach ($mangas as $manga) {
                $text .= $temp($manga);
            }
            return $text;
        });


    }

    public function getMangaProgress(Request $request)
    {
        $json = request()->cookie('flmhistory');
//        dd($json);
//        dd(json_decode($json));
        try {
            $array = json_decode($json, true);
//        dd($array);
            $array_manga = Manga::whereIn('id', array_keys($array))->select(['id', 'name', 'slug', 'poster'])->get();
        $array_chapter=Chapter::whereIn('id',array_values($array))->select(['id','name','manga_id','chapter_number'])->get();
//        dd($array_chapter);
//        dd($array_manga);
            $temp = function ($item) use ($array,$array_chapter) {
                return '<a class="black-text" href="' . route('manga', ['manga' => $item->slug, 'chapter' => $array[$item->id]]) . '">
                        <div class="col s12 m4 l4 ">
                            <div class="card horizontal in-progress-card">
                                <div class="card-image">
                                    <img height="80px" src="http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*&url=' . $item->poster . '">
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <p class="truncate">' . $item->name . '</p>
                                        <span class="truncate">Continue chapter :'.$array_chapter->where('manga_id',$item->id)->first()->chapter_number.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </a>';
            };

            $text = '';
            foreach ($array_manga as $manga) {
//            dd($manga->id);
                $text .= $temp($manga);
            }
            if ($text == '') {
                return 0;
            }
            return $text;
        } catch (\Exception $ex) {
            return 0;
        }

    }

    public function zremember($key,$number,$element,$expire){
        if (!Redis::exists($key)){
            Redis::zincrby($key,$number,$element);
                Redis::expire($key, $expire);
        }else{
            Redis::zincrby($key,$number,$element);
        }
    }

    public function updateView($manga){

        $this->zremember('manga.trending.hour',1,$manga,7200);
        $this->zremember('manga.trending.day',1,$manga,86400);
        Redis::zincrby('manga.view',1,$manga);
    }

    public function toggleFavorite($manga){
        $manga=Manga::find($manga);
        $user=auth()->user();
//        dd($user);
        if (!Redis::exists($manga_fav_cache_key=$manga->getCacheKey('favorite'))){
//            dd($manga);
            $manga->users()->get()->each(function ($user)use ($manga){
                Redis::sadd($manga->getCacheKey('favorite'),$user->id);
            });
        }
        $results=$user->mangas()->toggle($manga);
        if (!empty($results['attached'])){
            Redis::sadd($manga_fav_cache_key,$user->id);
            return 1;
        }elseif(!empty($results['detached'])){
            Redis::srem($manga_fav_cache_key,$user->id);
            return 0;
        }


//        dd(auth()->user());
    }

}
