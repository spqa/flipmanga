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

}
