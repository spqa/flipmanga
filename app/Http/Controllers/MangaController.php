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
//            $chapters=$manga->chapters()->paginate();
            $suggestion=Manga::inRandomOrder()->take(6)->get();
            return view('manga.manga_show',compact('manga','suggestion'));
        }
        $manga=Manga::whereSlug($manga)->first()->load('chapters');
        $chapter=$manga->chapters()->findOrFail($chapter);
        $next_link=$manga->chapters()->where('id','>',$chapter->id)->where('manga_id',$manga->id)->select(['id'])->min('id');
        $prev_link=$manga->chapters()->where('id','<',$chapter->id)->where('manga_id',$manga->id)->select(['id'])->max('id');
//        dd($next_link);
        $array_img=preg_split("/[\s,]+/", $chapter->img,-1,PREG_SPLIT_NO_EMPTY);
        $json=request()->cookie('flmhistory');
//        dd($json);
        if ($json!=null) {
            $array_history = json_decode($json, true);
        }
            $array_history[$manga->id]=$chapter->id;

        if (count($array_history)>3){
                foreach ($array_history as $key=>$value){
                    unset($array_history[$key]);
                    break;
                }
            }
//        dd($array_history);

//        dd($array_history);
//        $array_history[$manga->id]=$chapter->id;
        $json=json_encode($array_history);
//
//        dd($array_img);
        return response()->view('chapter.chapter_show',compact('manga','chapter','array_img','next_link','prev_link'))->cookie('flmhistory',$json,5040);
    }
}
