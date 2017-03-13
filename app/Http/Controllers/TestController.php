<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        dd(Manga::whereName('Bleach')->first());
    }
}
