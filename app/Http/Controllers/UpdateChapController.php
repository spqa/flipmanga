<?php

namespace App\Http\Controllers;

use App\Crawl\Heymanga\Chapter;
use App\Manga;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateChapController extends Controller
{
    public function getFromURL($url,$endSlug,$manga){
        $url = "https:". $url;
        $html=HtmlDomParser::file_get_html($url);
        $listChapter=[];
        foreach($html->find('#manga-list')[0]->find('option') as $select){
            if ($select->value!=null){
                $link=$select->value;
                if ($link == $endSlug) break;
                $text=trim($select->innertext());
                $array=explode(' ',$text);
                $number=array_pop($array);
                $chapter=new Chapter($number,$link);
                array_push($listChapter,$chapter);
                $text_img = $chapter->getArrayImage();
                $insertChap = new \App\Chapter();
                $insertChap->name = $text;
                $insertChap->img = $text_img;
                $insertChap->chapter_number = $number;
                $manga->chapters()->save($insertChap);
            }
        };
        return "done";
    }

    public function getFromIndex(){
        $html=HtmlDomParser::file_get_html('https://www.heymanga.me/');
        $listManga=[];

        foreach ($html->find('li[class=active]')[0]->find('.image-div') as $item) {
            $a = $item->find('a')[0];
            $href = $a->href;
            array_push($listManga,$href);
        }

        foreach ($listManga as $item) {
            $pos = strrpos($item,"/manga/");
            $last = strpos($item,"/",$pos);
            $endSlug = substr($item,0,$last-($pos+6)+1);
            $title = substr($item,($pos+7),$last-($pos+6));
            $title = str_replace("_","-",$title);
            $manga = Manga::where('slug',$title)->first();
            if (!empty($manga)){
                $lastest = $manga->getCacheLatestChap();
                if((int)$lastest == $lastest) {
                    $endSlug .= (int)$lastest;
                } else {
                    $endSlug .= $lastest;
                }
                $endSlug .= "/1";
                $this->getFromURL($item,$endSlug,$manga);
            }
        }
        return "done";
    }
}
