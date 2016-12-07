<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function genre($genre=null){
        if ($genre==null){
            return '';
        }
        $mangas=Manga::inRandomOrder()->take(12)->get();

    }
}
