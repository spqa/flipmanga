<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function seach($query){
        if ($query== null){
            abort(404);
        }


    }
}
