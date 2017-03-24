<?php

namespace App\Http\Controllers;

use App\Manga;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class TestController extends Controller
{
    public function index(){
        $dom=HtmlDomParser::file_get_html('http://thichtruyentranh.com/thuan-tinh-nha-dau-hoa-lat-lat/thuan-tinh-nha-dau-hoa-lat-lat-chap-3/127191.html');
        $imgText='';
        $imgArray=[];
        foreach ($dom->find('script') as $script){
            if (strpos($script->innertext(),'imgArray')!==false){
                $imgText=$script->innertext();
                break;
            }
        }

        if (!empty($imgText)){
            foreach (explode('"',$imgText) as $item){
                if (strpos($item,'imgur')){
                    array_push($imgArray,$item);
                }
            }
        }
        dd($imgArray);
        dd($dom->find('script'));
    }
}
