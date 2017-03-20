<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestMangaController extends Controller
{
    public function show(){
        return view('manga.manga_request');
    }

    public function store(Request $request){
        $this->validate($request,[
            'manga_name'=>'required'
        ]);
        \App\Request::create($request->all());
        return back()->with('success',1);
    }

}
