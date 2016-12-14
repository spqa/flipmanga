<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function favorites(){
        $mangas=auth()->user()->mangas()->get();
        return view('favorite_page',compact('mangas'));
    }
}
