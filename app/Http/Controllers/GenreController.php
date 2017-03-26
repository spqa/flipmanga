<?php

namespace App\Http\Controllers;

use App\Genre;
use App\Manga;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function show($genre=null){
        if ($genre==null){
            $genres=Genre::all();
            $mangas =Manga::take(24)->get();
            return view('genres_page',compact('genres','mangas'));
        }else{
            $genre=Genre::whereSlug($genre)->firstOrFail();
            $mangas=$genre->mangas()->orderBy('updated_at','desc')->paginate(24);
            return view('manga.manga_list_genre',compact('mangas','genre'));
        }
    }

    public function getBySlug($genre){
        if ($genre=='random'){
            $mangas=Manga::inRandomOrder()->take(12)->get();
        }else{
            $genre=Genre::whereSlug($genre)->firstOrFail();
            $mangas=$genre->mangas()->take(12)->get();
        }
        $mangas->load('authors','genres');
        foreach ($mangas as $manga){
            $manga->latestChap=$manga->getCacheLatestChap()->makeHidden('img');
            $manga->updated=$manga->updated_at->diffForHumans();
        }
        return $mangas;
    }

}
