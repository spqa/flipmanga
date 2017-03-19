<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        abort(500);
        dd(Manga::whereName('Bleach')->first());
    }
}
