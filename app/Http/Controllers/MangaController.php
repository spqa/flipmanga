<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;

class MangaController extends Controller
{
    public function show($manga,$chapter=null){
        if ($manga==null){
            abort(404);
        }elseif($chapter==null){
            $manga=Manga::whereSlug($manga)->firstOrFail()->load('chapters');
            $suggestion=Manga::inRandomOrder()->take(6)->get();
            return view('manga.manga_show',compact('manga','suggestion'));
        }
        $manga=Manga::whereSlug($manga)->first();
        $chapter=$manga->chapters()->findOrFail($chapter);
        $array_img=preg_split("/[\s,]+/", $chapter->img,-1,PREG_SPLIT_NO_EMPTY);
//        dd($array_img);
        return view('chapter.chapter_show',compact('chapter','array_img'));
    }
}
