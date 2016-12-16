<?php

namespace App\Http\Controllers;

use App\Crawl\Heymanga\Chapter;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateChapController extends Controller
{
    public function index(){
        $html=HtmlDomParser::file_get_html('https://www.heymanga.me/manga/Bluechair/383/1');
        $listChapter=[];
        foreach($html->find('#manga-list')[0]->find('option') as $select){
            if ($select->value!=null){
                $link=$select->value;
                $text=trim($select->innertext());
                $array=explode(' ',$text);
                $number=array_pop($array);
                $chapter=new Chapter($number,$link);
                array_push($listChapter,$chapter);
                $chapter->getArrayImage();
            }

        };

        dd($listChapter);
    }
}
