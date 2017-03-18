<?php

namespace App\Http\Controllers;

use App\Manga;
use App\UserUpload;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Request;

class MangaController extends Controller
{
    public function show($manga, $chapter_number = null, $chapter = null)
    {

        if ($manga == null) {

            abort(404);

        } elseif ($chapter == null) {
            $manga = Manga::whereSlug($manga)->firstOrFail()->load('chapters');;
//            dd($manga->getCacheKey('favorite'));
            $suggestion = Manga::inRandomOrder()->take(6)->get();
            $main_genre = $manga->getCachedGenres()->sortBy('name')->first();
            if (auth()->check()) {
                $is_fav = Redis::sismember($manga->getCacheKey('favorite'), auth()->user()->id);
            }
            return view('manga.manga_show', compact('manga', 'suggestion', 'main_genre', 'is_fav'));

        }


        $manga = Manga::whereSlug($manga)->first()->load('chapters');
        $chapter = $manga->chapters()->findOrFail($chapter);
        $next_link = $manga->chapters()->whereChapterNumber(DB::raw('(SELECT MIN(chapter_number) FROM chapters WHERE chapter_number > ' . $chapter->chapter_number . ' AND manga_id =' . $manga->id . ')'))->first();
        $prev_link = $manga->chapters()->whereChapterNumber(DB::raw('(SELECT MAX(chapter_number) FROM chapters WHERE chapter_number < ' . $chapter->chapter_number . ' AND manga_id =' . $manga->id . ')'))->first();
        $array_img = preg_split("/[\s,]+/", $chapter->img, -1, PREG_SPLIT_NO_EMPTY);
        if (empty($chapter->typeImg)) {
            for ($i = 0; $i < count($array_img); $i++) {
                $array_img[$i] = '//i1.heymanga.me/' . $array_img[$i];
            }
        }
        $json = request()->cookie('flmhistory');
        if ($json != null) {
            $array_history = json_decode($json, true);
        }
        $array_history[$manga->id] = $chapter->id;

        if (count($array_history) > 3) {
            foreach ($array_history as $key => $value) {
                unset($array_history[$key]);
                break;
            }
        }
        $json = json_encode($array_history);
        $main_genre = $manga->getCachedGenres()->sortBy('name')->first();


        return response()->view('chapter.chapter_show', compact('manga', 'chapter', 'array_img', 'next_link', 'prev_link', 'main_genre'))->cookie('flmhistory', $json, 5040);
    }

    public function create()
    {

        return view('manga.manga_create');
    }

    public function store(\Illuminate\Http\Request $request)
    {
//        dd($request->all());
        $image = '';
        foreach ($request->image as $item) {
            $image .= $item . ',';
        }
        UserUpload::create([
            'manga_name' => $request->manga_name,
            'chap_name' => $request->chap_name,
            'user_id' => auth()->user()->id,
            'image' => $image
        ]);
        return back();
    }

}
