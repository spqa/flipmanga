<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show($slug=null){
        if($slug){
            $post=Post::whereSlug($slug)->firstOrFail();
            return view('post.show',compact('post'));
        }else{
            $posts=Post::orderBy('created_at','desc')->paginate(24);
            return view('post.index',compact('posts'));
        }

    }
}
