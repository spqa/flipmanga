<?php

namespace App\Console\Commands;

use App\Manga;
use App\TypeImg;
use Illuminate\Console\Command;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateThichTruyen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:thichtruyen';

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
        //
        $this->getThichFromList();
    }

    public function getThichFromList()
    {
        for ($i = 1; $i < 236; $i++) {
            $listPage = HtmlDomParser::str_get_html(file_get_contents('http://thichtruyentranh.com/truyen-tranh.html?category=&order=7&page=' . $i));
            $ulList = $listPage->find('ul[class=ulListruyen]')[0];
            foreach ($ulList->find('li') as $item) {
                $this->getMangaThichTruyen($item->find('a')[0]->href);
            }
        }
    }

    public function getMangaThichTruyen($link)
    {
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://thichtruyentranh.com/'
        ]);
        $mangaPage = HtmlDomParser::str_get_html(file_get_contents('http://thichtruyentranh.com' . $link));
        $tmpManga = [];
        $tmpManga['poster'] = $mangaPage->find('div[class=divthum2]')[0]->find('img')[0]->src;
        $divListText = $mangaPage->find('div[class=divListtext]')[0];
        $tmpManga['oriTitle'] = $divListText->find('h1')[0]->text();
        $tmpManga['oriTitle'] = trim($tmpManga['oriTitle']);
        $tmpManga['alias'] = '';
        $tmpManga['author'] = '';
        $tmpManga['genre'] = '';
        $tmpManga['status'] = '';
        for ($i = 0; $i < sizeof($divListText->find('li')) - 3; $i++) {
            $string = $divListText->find('li')[$i]->find('div[class=item1]')[0]->text();
            switch ($string) {
                case 'Tên khác':
                    $tmpManga['alias'] = $divListText->find('li')[$i]->find('div[class=item2]')[0]->text();
                    $tmpManga['alias'] = substr($tmpManga['alias'], 2);
                    break;
                case 'Tác giả':
                    $tmpManga['author'] = $divListText->find('li')[$i]->find('div[class=item2]')[0]->find('a')[0]->text();
                    $tmpManga['author'] = trim($tmpManga['author']);
                    break;
                case 'Thể loại':
                    foreach ($divListText->find('li')[$i]->find('div[class=item2]')[0]->find('a') as $item) {
                        $tmpManga['genre'] .= $item->text() . ',';
                    }
                    break;
                case 'Tình trạng':
                    $tmpManga['status'] = $divListText->find('li')[$i]->find('div[class=item2]')[0]->find('span')[0]->text();
                    $tmpManga['status'] = trim($tmpManga['status']);
                    break;
            }
        }
        $tmpManga['description'] = trim($mangaPage->find('ul[class=ulpro_line]')[0]->find('li')[sizeof($mangaPage->find('ul[class=ulpro_line]')[0]->find('li')) - 1]->find('p')[1]->text());

        $manga = Manga::where('name', $tmpManga['oriTitle'])->first();
        if (empty($manga)) {
            $manga = Manga::create([
                'name' => $tmpManga['oriTitle'],
                'slug' => str_slug($tmpManga['oriTitle']),
                'poster' => $tmpManga['poster'],
                'status' => $tmpManga['status'],
                'description' => $tmpManga['description'],
                'translator' => '',
                'alias' => $tmpManga['alias'],
                'view' => 1,
            ]);
            foreach (explode(',',$tmpManga['genre']) as $item) {
                $insertGenre = Genre::firstOrCreate([
                    'name' => $item,
                    'slug' => str_slug($item)
                ]);
                $manga->genres()->attach($insertGenre);
            }
        }
        $this->comment('Insert: ' . $tmpManga['oriTitle']);
        $listChap = $mangaPage->find('div[id=listChapterBlock]')[0];
        if ($listChap->find('div[class=paging]') != null) {
            if ($listChap->find('div[class=paging]')[0]->find('li')[0]->find('a') == null) {
                $listChap = $mangaPage->find('div[id=listChapterBlock]')[0]->find('ul[class=ul_listchap]')[0]->find('li');
                foreach ($listChap as $item) {
                    $textName = $item->find('a')[0]->text();
                    $existChap = $manga->chapters()->where('name', $textName)->first();
                    if (isset($existChap)) continue;
//                if (stripos($textName, 'Chap ') !== false) {
//                    $index = stripos($textName, 'Chap ');
//                    if (strpos($textName, ':') !== false) {
//                        $numOfChap = substr($textName, $index + 5, strpos($textName, ':') - $index - 5);
//                    } else if (strpos($textName, ' ', $index + 5) != false) {
//                        $numOfChap = substr($textName, $index + 5, strpos($textName, ' ', $index + 5) - $index - 5);
//                    } else {
//                        $numOfChap = substr($textName, $index + 5);
//                    }
//                } else {
//                    $index = stripos($textName, 'Chapter ');
//                    if (strpos($textName, ':') !== false) {
//                        $numOfChap = substr($textName, $index + 8, strpos($textName, ':') - $index - 8);
//                    } else if (strpos($textName, ' ', $index + 8) != false) {
//                        $numOfChap = substr($textName, $index + 8, strpos($textName, ' ', $index + 8) - $index - 8);
//                    } else {
//                        $numOfChap = substr($textName, $index + 8);
//                    }
//                }
//                dd($item->find('a')[0]->href);
                    $textImg = $this->getImageThich($item->find('a')[0]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $textName;
                    $insertChap->img = $textImg;
                    $insertChap->slug = str_slug($textName);
                    $insertChap->chapter_number = $manga->chapters()->count() + 1;
                    $manga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
                    $this->comment($textName);
                }
            } else {
                if ($listChap->find('div[class=paging]')[0]->find('li[class=last]') != null) {
                    $lastLink = $listChap->find('div[class=paging]')[0]->find('li[class=last]')[0]->find('a')[0]->href;
                } else {
                    $lastLink = $listChap->find('div[class=paging]')[0]->find('li')[sizeof($listChap->find('div[class=paging]')[0]->find('li')) - 1]->find('a')[0]->href;
                }
                $lastPage = explode('.', $lastLink)[1];
                for ($i = 1; $i <= $lastPage; $i++) {
                    $chapterPage = HtmlDomParser::str_get_html(file_get_contents('http://thichtruyentranh.com' . str_replace('.' . $lastPage . '.', '.' . $i . '.', $lastLink)));
                    $listChap = $chapterPage->find('div[id=listChapterBlock]')[0]->find('ul[class=ul_listchap]')[0]->find('li');
                    foreach ($listChap as $item) {
                        $textName = $item->find('a')[0]->text();
                        $existChap = $manga->chapters()->where('name', $textName)->first();
                        if (isset($existChap)) continue;
//                    if (stripos($textName, 'Chap ') !== false) {
//                        $index = stripos($textName, 'Chap ');
//                        if (strpos($textName, ':') !== false) {
//                            $numOfChap = substr($textName, $index + 5, strpos($textName, ':') - $index - 5);
//                        } else if (strpos($textName, ' ', $index + 5) != false) {
//                            $numOfChap = substr($textName, $index + 5, strpos($textName, ' ', $index + 5) - $index - 5);
//                        } else {
//                            $numOfChap = substr($textName, $index + 5);
//                        }
//                    } else {
//                        $index = stripos($textName, 'Chapter ');
//                        if (strpos($textName, ':') !== false) {
//                            $numOfChap = substr($textName, $index + 8, strpos($textName, ':') - $index - 8);
//                        } else if (strpos($textName, ' ', $index + 8) != false) {
//                            $numOfChap = substr($textName, $index + 8, strpos($textName, ' ', $index + 8) - $index - 8);
//                        } else {
//                            $numOfChap = substr($textName, $index + 8);
//                        }
//                    }
//                    dd($item->find('a')[0]->href);
                        $textImg = $this->getImageThich($item->find('a')[0]->href);
                        $insertChap = new \App\Chapter();
                        $insertChap->name = $textName;
                        $insertChap->img = $textImg;
                        $insertChap->slug = str_slug($textName);
                        $insertChap->chapter_number = $textName;
                        $manga->chapters()->save($insertChap);
                        $insertChap->typeImg()->associate($type);
                        $insertChap->save();
                        $this->comment($textName);
                    }
                }
            }
        } else {
            $listChap = $mangaPage->find('div[id=listChapterBlock]')[0]->find('ul[class=ul_listchap]')[0]->find('li');
            foreach ($listChap as $item) {
                $textName = $item->find('a')[0]->text();
                $existChap = $manga->chapters()->where('name', $textName)->first();
                if (isset($existChap)) continue;
//                if (stripos($textName, 'Chap ') !== false) {
//                    $index = stripos($textName, 'Chap ');
//                    if (strpos($textName, ':') !== false) {
//                        $numOfChap = substr($textName, $index + 5, strpos($textName, ':') - $index - 5);
//                    } else if (strpos($textName, ' ', $index + 5) != false) {
//                        $numOfChap = substr($textName, $index + 5, strpos($textName, ' ', $index + 5) - $index - 5);
//                    } else {
//                        $numOfChap = substr($textName, $index + 5);
//                    }
//                } else {
//                    $index = stripos($textName, 'Chapter ');
//                    if (strpos($textName, ':') !== false) {
//                        $numOfChap = substr($textName, $index + 8, strpos($textName, ':') - $index - 8);
//                    } else if (strpos($textName, ' ', $index + 8) != false) {
//                        $numOfChap = substr($textName, $index + 8, strpos($textName, ' ', $index + 8) - $index - 8);
//                    } else {
//                        $numOfChap = substr($textName, $index + 8);
//                    }
//                }
//                dd($item->find('a')[0]->href);
                $textImg = $this->getImageThich($item->find('a')[0]->href);
                $insertChap = new \App\Chapter();
                $insertChap->name = $textName;
                $insertChap->img = $textImg;
                $insertChap->slug = str_slug($textName);
                $insertChap->chapter_number = $manga->chapters()->count() + 1;
                $manga->chapters()->save($insertChap);
                $insertChap->typeImg()->associate($type);
                $insertChap->save();
                $this->comment($textName);
            }
        }
    }

    public function getImageThich($link)
    {
//        dd(file_get_contents('http://thichtruyentranh.com/thuan-tinh-nha-dau-hoa-lat-lat/thuan-tinh-nha-dau-hoa-lat-lat-chap-3/127191.html'));
        $dom = HtmlDomParser::str_get_html(file_get_contents('http://thichtruyentranh.com' . $link));
        $imgText = '';
        $imgArray = "";
        foreach ($dom->find('script') as $script) {
            if (strpos($script->innertext(), 'imgArray') !== false) {
                $imgText = $script->innertext();
                break;
            }
        }

        if (!empty($imgText)) {
            foreach (explode('"', $imgText) as $item) {
                if (strpos($item, 'http') !== false) {
                    $imgArray .= $item . ",";
                }
            }
        }
        return $imgArray;
    }
}
