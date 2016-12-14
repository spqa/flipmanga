<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(){
        $query=request('query');
        $title_page='Search results of '.$query;
        $mangas=Manga::where('name','like','%'.$query.'%')->orWhere('alias','like','%'.$query.'%')->paginate(24);
        $page_description='There are '.$mangas->count().' result(s) for query '.$query;
        return view('manga.manga_list_custom',compact('title_page','mangas','page_description'));
    }
}
