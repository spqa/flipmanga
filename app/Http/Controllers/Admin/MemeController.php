<?php

namespace App\Http\Controllers\Admin;

use App\Meme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MemeController extends Controller
{
    public function index(){
        $memes=Meme::orderBy('created_at','desc')->paginate('10');
        return view('admin.check_meme',compact('memes'));
    }

    public function check($id){
        $meme=Meme::findOrFail($id);
        $meme->check=true;
        $meme->save();
        return redirect()->route('meme.admin.index');
    }

    public function uncheck($id){
        $meme=Meme::findOrFail($id);
        $meme->check=false;
        $meme->save();
        return redirect()->route('meme.admin.index');
    }

    public function delete($id){
        $meme=Meme::findOrFail($id);
        $meme->delete();
        return redirect()->route('meme.admin.index');
    }
}
