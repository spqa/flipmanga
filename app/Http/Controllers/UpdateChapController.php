<?php

namespace App\Http\Controllers;

use App\Crawl\Heymanga\Chapter;
use App\Genre;
use App\Manga;
use Carbon\Carbon;
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

    public function getFullManga($url,$manga){
        $url = "https:". $url;
        $html=HtmlDomParser::file_get_html($url);
        $listChapter=[];
        foreach($html->find('#manga-list')[0]->find('option') as $select){
            if ($select->value!=null){
                $link=$select->value;
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
            $tmp = [];
            $a = $item->find('a')[0];
            $tmp['link'] = $a->href;
            $tmp['title'] = $a->title;
            array_push($listManga,$tmp);
        }

        foreach ($listManga as $item) {
            $title = substr($item['title'],0,strrpos($item['title'],' ',0));
            $slug = str_slug($title);
            $array_split=explode('/',$item['link']);
            $endSlug='//www.heymanga.me/manga/'.$array_split[4].'/';
//            dd($array_split);
            $manga = Manga::where('slug','like','%'.$slug.'%')->first();
            if (!empty($manga)){
                $lastest = $manga->getCacheLatestChap();
                if((int)$lastest == $lastest) {
                    $endSlug .= (int)$lastest;
                } else {
                    $endSlug .= $lastest;
                }
                $endSlug .= "/1";
                dd($manga);
                $this->getFromURL($item['link'],$endSlug,$manga);
            } else {
                $detaiPage = HtmlDomParser::file_get_html('https://www.heymanga.me/manga/'.$array_split[4]);
                $poster = $detaiPage->find('#manga1')[0]->find('img')[0]->src;
                $detai = $detaiPage->find('ul[class=lead]')[0];
                $name = $detai->find('li')[0]->innertext();
                $name = str_replace('<br/>','',$name);
                $name = str_replace('Name: ','',$name);
                $name = trim($name);
                $year =  $detai->find('li')[1]->innertext();
                $year = str_replace('Year of Release: ','',$year);
                $year = str_replace('<br/>','',$year);
                $year = str_replace('</b>','',$year);
                $year = trim($year);
                $status = $detai->find('li')[2]->innertext();
                $status = str_replace('Status: ','',$status);
                $status = trim($status);
                $lstGenre = $detai->find('li')[3];
                $pilot = $detai->find('li')[4]->innertext();
                $pilot = str_replace('Plot: &nbsp;','',$pilot);
                $pilot = str_replace('</br>','',$pilot);
                $pilot = str_replace('</b>','',$pilot);
                $pilot = trim($pilot);
                if ($status == '-') $status = 'Continue';
                $insertManga = Manga::create([
                    'name' => $name,
                    'slug' => str_slug($name),
                    'poster' => $poster,
                    'status' =>$status,
                    'description' =>$pilot,
                    'translator' => '',
                    'alias' => '',
                    'view' => 1,
                    'released_at' => Carbon::parse($year),
                ]);
                foreach ($lstGenre->find('a') as $item1) {
                    $item1 = trim($item1);
                    $insertGenre = Genre::firstOrCreate([
                        'name' => $item1,
                    ]);
                    $insertManga->genres()->attach($insertGenre);
                }
                $this->getFullManga($item1,$insertManga);
            }
        }
        return "done";
    }
}
