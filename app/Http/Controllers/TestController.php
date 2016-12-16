<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        $array=['1','2','3'=>'fsdfsd'];
        dd(array_values($array));
    }
}
