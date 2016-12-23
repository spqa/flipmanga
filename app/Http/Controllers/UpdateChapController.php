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
                $this->getFullManga($item,$insertManga);
            }
        }
        return "done";
    }

    public function getMangaFox(){
        $html=HtmlDomParser::file_get_html('http://mangafox.me/directory/1?az');
        $listManga = $html->find('ul[class=list]')[0];
        $link = [];
        foreach ($listManga->find('li') as $item) {
            array_push($link,$item->find('a[class=manga_img]')[0]->href);
        }
        dd(Carbon::createFromDate('2014'));
        foreach ($link as $item) {
            $mangaPage=HtmlDomParser::file_get_html($item);
            $divTitle = $mangaPage->find('div[id=title]')[0];
            $tmpManga = [];
            $titleAndType = $divTitle->find('h1')[0]->innertext();
            $tmpManga['oriTitle'] = substr($titleAndType,0,strrpos($titleAndType,' '));
            $tmpManga['type'] = substr($titleAndType,strrpos($titleAndType,' ')+1,strlen($titleAndType));
            $aliasText = $divTitle->find('h3')[0]->innertext();
            $alias = $divTitle->find('h3')[0];
            $tmpManga['alias'] = '';
            $tmpManga['alias'] .= substr($aliasText,0,strpos($aliasText,';')) . ',';
            foreach ($alias->find('a') as $item1) {
                $tmpManga['alias'] .= $item1->innertext() . ',';
            }
            $tmpManga['alias'] = substr($tmpManga['alias'],0,strlen($tmpManga['alias'])-1);
            //$tmpManga['alias'] = ;
            $tmpManga['released'] = $divTitle->find('td')[0]->find('a')[0]->innertext();
            $tmpManga['author'] = $divTitle->find('td')[1]->find('a')[0]->innertext();
            $tmpManga['artist'] = $divTitle->find('td')[2]->find('a')[0]->innertext();
            $tmpManga['genre'] = '';
            foreach ($divTitle->find('td')[3]->find('a') as $item2) {
                $tmpManga['genre'] .= $item2->innertext() .',';
            }
            $tmpManga['genre'] = substr($tmpManga['genre'],0,strlen($tmpManga['genre'])-1);
            $tmpManga['cover'] = $mangaPage->find('div[class=cover]')[0]->find('img')[0]->src;
            $urlMangaM = str_replace('mangafox.me','m.mangafox.me',$item);
            $mangaPageM=HtmlDomParser::file_get_html($urlMangaM);
            $status = explode(' ',$mangaPageM->find('div[class=detail-info]')[0]->find('p')[1]->innertext());
            $tmpManga['status'] = $status[2];
            $tmpManga['description'] = trim($mangaPageM->find('div[class=manga-summary]')[0]->innertext());
            $tmpManga['description'] = preg_replace('/\s+/', ' ',$tmpManga['description']);
            array_push();
        }
    }
}
