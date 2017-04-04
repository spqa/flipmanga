<?php

namespace App\Http\Controllers;

use App\Meme;
use Intervention\Image\Image;

class MemeController extends Controller
{
    public function index($slug = null)
    {
        if ($slug) {
            $meme = Meme::whereSlug($slug)->firstOrFail();
            return view('meme.show',compact('meme'));
        }

        $memes=Meme::orderBy('created_at','desc')->paginate(10);
        return view('meme.index',compact('memes'));
    }

    public function create(){
        return view('meme.create');
    }

    public function previewMeme(){
        $img=request('image');
        $up=request('up');
        $down=request('down');
        return $this->generateMeme($img,$up,$down);
    }
    public function generateMeme($image,$up,$down){
        $img=\Intervention\Image\Facades\Image::make($image);
        $font_path=public_path('fonts/unicode.impact.ttf');
        $name=time();
        $img->text($up, $img->width()/2, 20, function ($font)use ($font_path) {
            $font->file($font_path);
            $font->size(34);
            $font->color("#ffffff");
            $font->align('center');
            $font->valign('top');
        });
        $img->text($down, $img->width()/2, $img->height()-40, function ($font)use ($font_path) {
            $font->file($font_path);
            $font->size(34);
            $font->color("#ffffff");
            $font->align('center');
            $font->valign('top');
        });
        $img->save(storage_path('app/public/images/temp/'.$name.'.jpg'));
        return $name;
    }
}
