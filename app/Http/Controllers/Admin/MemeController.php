<?php

namespace App\Http\Controllers\Admin;

use App\Meme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MemeController extends Controller
{
    public function index(){
        $memes=Meme::where('check','!=',1)->orWhereNull('check')->orderBy('created_at','desc')->paginate('10');
        return view('admin.check_meme',compact('memes'));
    }

    public function check($id){
        $meme=Meme::find($id);
        $meme->check=true;
        $meme->save();
        return back();
    }
}
