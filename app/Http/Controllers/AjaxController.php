<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AjaxController extends Controller
{
    public function genre($genre = null)
    {
        if ($genre == null) {
            return '';
        }
        if ($genre=='random'){
            $mangas = Manga::inRandomOrder()->select(['poster', 'slug', 'updated_at', 'name'])->take(12)->get();
//            dd($mangas);
            $temp = function ($array) {
                return '<a class="black-text" href="' . $array->name . '" rel="contents">
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <img class="manga-poster" src="' . $array->poster . '" />
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3">' . $array->name . '</h3>
                <span class="truncate"><div class="chip small-tag">harem</div>
                        <div class="chip small-tag">romance</div><div class="chip small-tag">romance</div>
                      </span>
                <p class="padding-0 margin-0">Chap: ' . $array->chap . '</p>
                <p class="truncate padding-0 margin-0">Author: ' . $array->author . '</p>
                <p class="padding-0 margin-0">View :' . $array->view . '</p>
                <span class="badge green white-text past-timer">' . $array->updated_at->diffForHumans() . '</span>
            </div>
        </div>
    </div>
</div>
</a>';
            };
            $text='';
            foreach ($mangas as $manga) {
                $text.=$temp($manga);
            }
            return $text;
        }
        return Cache::remember('genre:'.$genre,30, function () {
            $mangas = Manga::inRandomOrder()->select(['poster', 'slug', 'updated_at', 'name'])->take(12)->get();
//            $mangas = Manga::orderBy('updated_at', 'desc')->select(['poster', 'slug', 'updated_at', 'name'])->take(12)->get();
//            dd($mangas);
            $temp = function ($array) {
                return '<a class="black-text" href="' . $array->name . '" rel="contents">
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <img class="manga-poster" src="' . $array->poster . '" />
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3">' . $array->name . '</h3>
                <span class="truncate"><div class="chip small-tag">harem</div>
                        <div class="chip small-tag">romance</div><div class="chip small-tag">romance</div>
                      </span>
                <p class="padding-0 margin-0">Chap: ' . $array->chap . '</p>
                <p class="truncate padding-0 margin-0">Author: ' . $array->author . '</p>
                <p class="padding-0 margin-0">View :' . $array->view . '</p>
                <span class="badge green white-text past-timer">' . $array->updated_at->diffForHumans() . '</span>
            </div>
        </div>
    </div>
</div>
</a>';
            };
            $text='';
            foreach ($mangas as $manga) {
                $text.=$temp($manga);
            }
            return $text;
        });


    }
}
