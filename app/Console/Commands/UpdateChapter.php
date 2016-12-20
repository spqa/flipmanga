<?php

namespace App\Console\Commands;

use App\Crawl\Heymanga\Chapter;
use App\Manga;
use Illuminate\Console\Command;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateChapter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:Chapter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $html=HtmlDomParser::file_get_html('https://www.heymanga.me/');
        $listManga=[];

        foreach ($html->find('li[class=active]')[0]->find('.image-div') as $item) {
            $a = $item->find('a')[0];
            $href = $a->href;
            array_push($listManga,$href);
        }

//        dd($listManga);

        foreach ($listManga as $item) {
//            $pos = strrpos($item,"/manga/");
//            $last = strpos($item,"/",$pos);
//            $endSlug = substr($item,0,$last-($pos+6)+1);
//            $this->comment($endSlug);
//            $title = substr($item,($pos+7),$last-($pos+6));
            $array_split=explode('/',$item);
//            dd($array_split);
            $title=$array_split[4];
            $title = str_replace("_","-",$title);
            $this->comment($title);

            $manga = Manga::where('slug','like','%'.$title.'%')->first();
            if (!empty($manga)){
                $lastest = $manga->getCacheLatestChap();
                $endSlug='//www.heymanga.me/manga/'.$array_split[4].'/';
                if((int)$lastest == $lastest) {
                    $endSlug .= (int)$lastest;
                } else {
                    $endSlug .= $lastest;
                }
                $endSlug .= "/1";
//                dd($endSlug);
                $this->getFromURL($item,$endSlug,$manga);
            }
        }
    }

    public function getFromURL($url,$endSlug,$manga){
        $url = "https:". $url;
        $html=HtmlDomParser::file_get_html($url);
        $listChapter=[];
        $this->comment('start url:'.$url);
        foreach($html->find('#manga-list')[0]->find('option') as $select){
            if ($select->value!=null){
                $link=$select->value;
                $this->comment($link);
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
                $this->comment($text);
            }
        };
    }
}
