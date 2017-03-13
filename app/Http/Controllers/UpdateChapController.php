<?php

namespace App\Http\Controllers;

use App\Category;
use App\Crawl\Heymanga\Chapter;
use App\Genre;
use App\Manga;
use App\TypeImg;
use Carbon\Carbon;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateChapController extends Controller
{
    public function getFromURL($url, $endSlug, $manga)
    {
        $url = "https:" . $url;
        $html = HtmlDomParser::file_get_html($url);
        $listChapter = [];
        foreach ($html->find('#manga-list')[0]->find('option') as $select) {
            if ($select->value != null) {
                $link = $select->value;
                if ($link == $endSlug) break;
                $text = trim($select->innertext());
                $array = explode(' ', $text);
                $number = array_pop($array);
                $chapter = new Chapter($number, $link);
                array_push($listChapter, $chapter);
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

    public function getFullManga($url, $manga)
    {
        $url = "https:" . $url;
        $html = HtmlDomParser::file_get_html($url);
        $listChapter = [];
        foreach ($html->find('#manga-list')[0]->find('option') as $select) {
            if ($select->value != null) {
                $link = $select->value;
                $text = trim($select->innertext());
                $array = explode(' ', $text);
                $number = array_pop($array);
                $chapter = new Chapter($number, $link);
                array_push($listChapter, $chapter);
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

    public function getFromIndex()
    {
        $html = HtmlDomParser::file_get_html('https://www.heymanga.me/');
        $listManga = [];

        foreach ($html->find('li[class=active]')[0]->find('.image-div') as $item) {
            $tmp = [];
            $a = $item->find('a')[0];
            $tmp['link'] = $a->href;
            $tmp['title'] = $a->title;
            array_push($listManga, $tmp);
        }

        foreach ($listManga as $item) {
            $title = substr($item['title'], 0, strrpos($item['title'], ' ', 0));
            $slug = str_slug($title);
            $array_split = explode('/', $item['link']);
            $endSlug = '//www.heymanga.me/manga/' . $array_split[4] . '/';
//            dd($array_split);
            $manga = Manga::where('slug', 'like', '%' . $slug . '%')->first();
            if (!empty($manga)) {
                $lastest = $manga->getCacheLatestChap();
                if ((int)$lastest == $lastest) {
                    $endSlug .= (int)$lastest;
                } else {
                    $endSlug .= $lastest;
                }
                $endSlug .= "/1";
                $this->getFromURL($item['link'], $endSlug, $manga);
            } else {
                $detaiPage = HtmlDomParser::file_get_html('https://www.heymanga.me/manga/' . $array_split[4]);
                $poster = $detaiPage->find('#manga1')[0]->find('img')[0]->src;
                $detai = $detaiPage->find('ul[class=lead]')[0];
                $name = $detai->find('li')[0]->innertext();
                $name = str_replace('<br/>', '', $name);
                $name = str_replace('Name: ', '', $name);
                $name = trim($name);
                $year = $detai->find('li')[1]->innertext();
                $year = str_replace('Year of Release: ', '', $year);
                $year = str_replace('<br/>', '', $year);
                $year = str_replace('</b>', '', $year);
                $year = trim($year);
                $status = $detai->find('li')[2]->innertext();
                $status = str_replace('Status: ', '', $status);
                $status = trim($status);
                $lstGenre = $detai->find('li')[3];
                $pilot = $detai->find('li')[4]->innertext();
                $pilot = str_replace('Plot: &nbsp;', '', $pilot);
                $pilot = str_replace('</br>', '', $pilot);
                $pilot = str_replace('</b>', '', $pilot);
                $pilot = trim($pilot);
                if ($status == '-') $status = 'Continue';
                $insertManga = Manga::create([
                    'name' => $name,
                    'slug' => str_slug($name),
                    'poster' => $poster,
                    'status' => $status,
                    'description' => $pilot,
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
                $this->getFullManga($item, $insertManga);
            }
        }
        return "done";
    }

    public function getMangaFox()
    {
        $html = HtmlDomParser::file_get_html('http://mangafox.me/directory/1?az');
        $listManga = $html->find('ul[class=list]')[0];
        $link = [];
        foreach ($listManga->find('li') as $item) {
            array_push($link, $item->find('a[class=manga_img]')[0]->href);
        }

        foreach ($link as $item) {
            $mangaPage = HtmlDomParser::file_get_html($item);
            $divTitle = $mangaPage->find('div[id=title]')[0];
            $tmpManga = [];
            $titleAndType = $divTitle->find('h1')[0]->innertext();
            $tmpManga['oriTitle'] = substr($titleAndType, 0, strrpos($titleAndType, ' '));
            $tmpManga['type'] = substr($titleAndType, strrpos($titleAndType, ' ') + 1, strlen($titleAndType));
            $tmpManga['alias'] = '';
            if ($divTitle->find('h3') != null) {
                $aliasText = $divTitle->find('h3')[0]->text();
                $tmpManga['alias'] = str_replace(';', ',', $aliasText);
            }
            $tmpManga['released'] = $divTitle->find('td')[0]->find('a')[0]->innertext();
            $tmpManga['released'] = trim($tmpManga['released']);
            if ($tmpManga['author'] = $divTitle->find('td')[1]->find('a') != null) $tmpManga['author'] = $divTitle->find('td')[1]->find('a')[0]->text();
            else $tmpManga['author'] = $divTitle->find('td')[1]->text();
            $tmpManga['author'] = trim($tmpManga['author']);
            if ($tmpManga['artist'] = $divTitle->find('td')[2]->find('a') != null) $tmpManga['artist'] = $divTitle->find('td')[2]->find('a')[0]->text();
            else $tmpManga['artist'] = $divTitle->find('td')[2]->text();
            $tmpManga['artist'] = trim($tmpManga['artist']);
            $tmpManga['genre'] = '';
            foreach ($divTitle->find('td')[3]->find('a') as $item2) {
                $tmpManga['genre'] .= $item2->text() . ',';
            }
            $tmpManga['genre'] = substr($tmpManga['genre'], 0, strlen($tmpManga['genre']) - 1);
            $tmpManga['genre'] = trim($tmpManga['genre']);
            $tmpManga['cover'] = $mangaPage->find('div[class=cover]')[0]->find('img')[0]->src;
            $urlMangaM = str_replace('mangafox.me', 'm.mangafox.me', $item);
            $mangaPageM = HtmlDomParser::file_get_html($urlMangaM);
            $status = explode(' ', $mangaPageM->find('div[class=detail-info]')[0]->find('p')[1]->innertext());
            $tmpManga['status'] = $status[2];
            $tmpManga['description'] = trim($mangaPageM->find('div[class=manga-summary]')[0]->innertext());
            $tmpManga['description'] = preg_replace('/\s+/', ' ', $tmpManga['description']);
//            dd($tmpManga);
            $manga = Manga::where('name', 'like', '%' . $tmpManga['oriTitle'] . '%')->first();
            if (!empty($manga)) {

            } else {
                $cate = Category::firstOrCreate([
                    'name' => $tmpManga['type'],
                    'slug' => str_slug($tmpManga['type'])
                ]);

                $type = TypeImg::firstOrCreate([
                    'prefix' => 'http://i.imgur.com/'
                ]);

                $insertManga = Manga::create([
                    'name' => $tmpManga['oriTitle'],
                    'slug' => str_slug($tmpManga['oriTitle']),
                    'poster' => $this->uploadImg($tmpManga['cover']),
                    'status' => $tmpManga['status'],
                    'description' => $tmpManga['description'],
                    'translator' => '',
                    'alias' => $tmpManga['alias'],
                    'view' => 1,
                    'released_at' => Carbon::createFromDate($tmpManga['released'])
                ]);

                $insertManga->categories()->attach($cate);
                $genres = explode(',', $tmpManga['genre']);
                foreach ($genres as $genre) {
                    $genre = trim($genre);
                    $insertGenre = Genre::firstOrCreate([
                        'name' => $genre,
                    ]);
                    $insertManga->genres()->attach($insertGenre);
                }

                $listVol = $mangaPageM->find('dd[class=chlist]');
                foreach ($listVol as $vol) {
                    $listChap = $vol->find('a');
                    foreach ($listChap as $chap) {
                        $titleChap = $chap->text();
                        $titleChap = preg_replace('/\s+/', ' ', $titleChap);
                        $numOfChap = explode(' ', $titleChap)[2];
                        $urlChap = $chap->href;
                        $urlChap = str_replace_first('/manga/', '/roll_manga/', $urlChap);
                        $chapPage = HtmlDomParser::file_get_html($urlChap);
                        $imgs = $chapPage->find('img[class=reader-page]');
                        $linkUpload = '';
                        foreach ($imgs as $img) {
                            $urlImg = $img->getAttribute('data-original');
                            $urlImg = str_replace_first('&amp;', '&', $urlImg);
                            $upload = $this->uploadImg($urlImg);
                            $pos = strrpos($upload, '/');
                            $upload = substr($upload, $pos + 1);
                            $linkUpload .= $upload . ',';
                        }
                        $insertChap = new \App\Chapter();
                        $insertChap->name = $tmpManga['oriTitle'] . " " . $numOfChap;
                        $insertChap->img = $linkUpload;
                        $insertChap->chapter_number = $numOfChap;
                        $insertManga->chapters()->save($insertChap);
                        $insertChap->typeImg()->attach($type);
                    }
                }
                dd($insertManga);
            }
        }
    }

    public function uploadImg($img)
    {
        $client = new \Imgur\Client();
        $client->setOption('client_id', '60e1edd757af5ca');
        $client->setOption('client_secret', '0b6fbec404305c1104b311c5be3369a9828824e0');

        if (isset($_SESSION['token'])) {
            $client->setAccessToken($_SESSION['token']);

            if ($client->checkAccessTokenExpired()) {
                $client->refreshToken();
            }
        } elseif (isset($_GET['code'])) {
            $client->requestAccessToken($_GET['code']);
            $_SESSION['token'] = $client->getAccessToken();
        }
//        } else {
//            echo '<a href="'.$client->getAuthenticationUrl().'">Click to authorize</a>';
//        }

        $imageData = [
            'image' => $img,
            'type' => 'url',
        ];

        $json = $client->api('image')->upload($imageData);

        return $json['link'];
    }

    public function getImage($linkChap)
    {
        $chapPage = HtmlDomParser::file_get_html('http://www.mangareader.net' . $linkChap);
        $listPage = $chapPage->find('select[id=pageMenu]')[0]->find('option');
        $textImg = '';
        foreach ($listPage as $page) {
            $imgPage = HtmlDomParser::file_get_html('http://www.mangareader.net' . $page->value);
            $textImg = $textImg . $imgPage->find('img[id=img]')[0]->src . ',';
        }
        return $textImg;
    }

    public function getMangaReader()
    {
        $html = HtmlDomParser::file_get_html('http://www.mangareader.net/alphabetical');
        $listManga = $html->find('ul[class=series_alpha]');
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://www.mangareader.net/'
        ]);
        foreach ($listManga as $item) {
            foreach ($item->find('li') as $li) {
                $mangaPage = HtmlDomParser::file_get_html('http://www.mangareader.net' . $li->find('a')[0]->href);
                $info = $mangaPage->find('table')[0];
                $tmpManga = [];
                $tmpManga['poster'] = $mangaPage->find('div[id=mangaimg]')[0]->find('img')[0]->src;
                $tmpManga['oriTitle'] = $info->find('td')[1]->find('h2')[0]->innertext();
                $tmpManga['oriTitle'] = trim($tmpManga['oriTitle']);
                $tmpManga['alias'] = $info->find('td')[3]->innertext();
                $tmpManga['alias'] = trim($tmpManga['alias']);
                $tmpManga['released'] = $info->find('td')[5]->innertext();
                $tmpManga['released'] = trim($tmpManga['released']);
                $tmpManga['status'] = $info->find('td')[7]->innertext();
                $tmpManga['status'] = trim($tmpManga['status']);
                $tmpManga['author'] = $info->find('td')[9]->innertext();
                $tmpManga['author'] = trim($tmpManga['author']);
                $tmpManga['artist'] = $info->find('td')[11]->innertext();
                $tmpManga['artist'] = trim($tmpManga['artist']);
                $tmpManga['description'] = $mangaPage->find('div[id=readmangasum]')[0]->find('p')[0]->innertext();
                $manga = Manga::where('name', 'like', '%' . $tmpManga['oriTitle'] . '%')->first();
                $listChap = $mangaPage->find('table[id=listing]')[0]->find('a');

                if (!empty($manga)) {//$manga !=null
                    $lastest = $manga->getCacheLatestChap();
                    for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[0]);
                        $numOfChap = substr($nameChap, strlen($tmpManga['oriTitle']) + 1);
                        if (strcmp($lastest, $numOfChap) == 0) continue;
                        $textImg = $this->getImage($listChap[$i]->href);
                        $insertChap = new \App\Chapter();
                        $insertChap->name = $nameChap;
                        $insertChap->img = $textImg;
                        $insertChap->chapter_number = $numOfChap;
                        $manga->chapters()->save($insertChap);
                        $insertChap->typeImg()->associate($type);
                        $insertChap->save();
                    }
                } else {
                    //$$manga=null
                    $insertManga = Manga::create([
                        'name' => $tmpManga['oriTitle'],
                        'slug' => str_slug($tmpManga['oriTitle']),
                        'poster' => $tmpManga['poster'],
                        'status' => $tmpManga['status'],
                        'description' => $tmpManga['description'],
                        'translator' => '',
                        'alias' => $tmpManga['alias'],
                        'view' => 1,
                        'released_at' => Carbon::createFromDate($tmpManga['released'])
                    ]);
                    foreach ($info->find('td')[15]->find('span') as $item) {
                        $genre = $item->innertext();
                        $genre = trim($genre);
                        $insertGenre = Genre::firstOrCreate([
                            'name' => $genre,
                        ]);
                        $insertManga->genres()->attach($insertGenre);
                    }
                    for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[0]);
                        $numOfChap = substr($nameChap, strlen($tmpManga['oriTitle']) + 1);
                        $textImg = $this->getImage($listChap[$i]->href);
                        $insertChap = new \App\Chapter();
                        $insertChap->name = $nameChap;
                        $insertChap->img = $textImg;
                        $insertChap->chapter_number = $numOfChap;
                        $insertManga->chapters()->save($insertChap);
                        $insertChap->typeImg()->associate($type);
                        $insertChap->save();
                    }
                    dd('done');
                }
            }
            dd('done');
        }
    }

    public function getFromReaderIndex()
    {
        $index = HtmlDomParser::file_get_html('http://www.mangareader.net/');
        $divLastest = $index->find('div[id=latestchapters]')[0];
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://www.mangareader.net/'
        ]);
        foreach ($divLastest->find('a[class=chapter]') as $mangaNew) {
            $mangaPage = HtmlDomParser::file_get_html('http://www.mangareader.net' . $mangaNew->href);
            $info = $mangaPage->find('table')[0];
            $tmpManga = [];
            $tmpManga['poster'] = $mangaPage->find('div[id=mangaimg]')[0]->find('img')[0]->src;
            $tmpManga['oriTitle'] = $info->find('td')[1]->find('h2')[0]->innertext();
            $tmpManga['oriTitle'] = trim($tmpManga['oriTitle']);
            $tmpManga['alias'] = $info->find('td')[3]->innertext();
            $tmpManga['alias'] = trim($tmpManga['alias']);
            $tmpManga['released'] = $info->find('td')[5]->innertext();
            $tmpManga['released'] = trim($tmpManga['released']);

            $tmpManga['status'] = $info->find('td')[7]->innertext();
            $tmpManga['status'] = trim($tmpManga['status']);
            $tmpManga['author'] = $info->find('td')[9]->innertext();
            $tmpManga['author'] = trim($tmpManga['author']);
            $tmpManga['artist'] = $info->find('td')[11]->innertext();
            $tmpManga['artist'] = trim($tmpManga['artist']);
            $tmpManga['description'] = $mangaPage->find('div[id=readmangasum]')[0]->find('p')[0]->innertext();
            $manga = Manga::where('name', 'like', '%' . $tmpManga['oriTitle'] . '%')->first();
            $listChap = $mangaPage->find('table[id=listing]')[0]->find('a');

            if (!empty($manga)) {//$manga !=null
                $lastest = $manga->getCacheLatestChap();
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = trim(explode(':', $listChap[$i]->innertext())[0]);
                    $numOfChap = substr($nameChap, strlen($tmpManga['oriTitle']) + 1);
                    if (strcmp($lastest, $numOfChap) == 0) continue;
                    $textImg = $this->getImage($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $manga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                }
            } else {
                //$manga=null
                $insertManga = Manga::create([
                    'name' => $tmpManga['oriTitle'],
                    'slug' => str_slug($tmpManga['oriTitle']),
                    'poster' => $tmpManga['poster'],
                    'status' => $tmpManga['status'],
                    'description' => $tmpManga['description'],
                    'translator' => '',
                    'alias' => $tmpManga['alias'],
                    'view' => 1,
                    'released_at' => Carbon::createFromDate($tmpManga['released'])
                ]);
                foreach ($info->find('td')[15]->find('span') as $item) {
                    $genre = $item->innertext();
                    $genre = trim($genre);
                    $insertGenre = Genre::firstOrCreate([
                        'name' => $genre,
                    ]);
                    $insertManga->genres()->attach($insertGenre);
                }
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = trim(explode(':', $listChap[$i]->innertext())[0]);
                    $numOfChap = substr($nameChap, strlen($tmpManga['oriTitle']) + 1);
                    $textImg = $this->getImage($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $insertManga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
                }
                dd('done');
            }
        }
    }

    public function getComicVN()
    {
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://comicvn.net/'
        ]);
        $i = 1;
        while ($i < 14000) {
            $mangaPage = null;
            try{
                $mangaPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net/truyen-tranh-online/abc-'.$i));
            } catch (\Exception $exception){
                $i++;
                continue;
            }
//            if (sizeof($mangaPage->find('div[class=404-main text-center]'))==1) {
//                $i++;
//                continue;
//            }
            $info = $mangaPage->find('div[class=manga-info-main]')[0];
            $tmpManga = [];
            $tmpManga['poster'] = $info->find('div[class=col-xs-3]')[0]->find('img')[0]->src;
            $tmpManga['oriTitle'] = $info->find('div[class=sub-bor]')[0]->find('h1')[0]->innertext();
            $tmpManga['oriTitle'] = trim($tmpManga['oriTitle']);
            $ulInfo = $info->find('div[class=col-xs-9]')[0]->find('ul')[0];
            $tmpManga['alias'] = '';
            $tmpManga['artist'] = '';
            $tmpManga['author'] = '';
            $tmpManga['status'] = '';
            $tmpManga['cate'] = '';
            if (sizeof($ulInfo->find('li')[2]->find('span')) == 1) {
                $tmpManga['alias'] = $ulInfo->find('li')[2]->innertext();
                $tmpManga['alias'] = substr($tmpManga['alias'], strrpos($tmpManga['alias'], '>') + 1);
                $tmpManga['alias'] = str_replace('&nbsp;', '', $tmpManga['alias']);
                $tmpManga['alias'] = trim($tmpManga['alias']);
            } else $tmpManga['alias'] = $ulInfo->find('li')[2]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[1]->find('span')) == 1) {
                $tmpManga['artist'] = $ulInfo->find('li')[1]->innertext();
                $tmpManga['artist'] = substr($tmpManga['artist'], strrpos($tmpManga['artist'], '>') + 1);
                $tmpManga['artist'] = str_replace('&nbsp;', '', $tmpManga['artist']);
                $tmpManga['artist'] = trim($tmpManga['artist']);
            } else $tmpManga['artist'] = $ulInfo->find('li')[1]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[0]->find('span')) == 1) {
                $tmpManga['author'] = $ulInfo->find('li')[0]->innertext();
                $tmpManga['author'] = substr($tmpManga['author'], strrpos($tmpManga['author'], '>') + 1);
                $tmpManga['author'] = str_replace('&nbsp;', '', $tmpManga['author']);
                $tmpManga['author'] = trim($tmpManga['author']);
            } else $tmpManga['author'] = $ulInfo->find('li')[0]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[6]->find('span')) == 1) {
                $tmpManga['status'] = $ulInfo->find('li')[6]->innertext();
                $tmpManga['status'] = substr($tmpManga['status'], strrpos($tmpManga['status'], '>') + 1);
                $tmpManga['status'] = str_replace('&nbsp;', '', $tmpManga['status']);
                $tmpManga['status'] = trim($tmpManga['status']);
            } else $tmpManga['status'] = $ulInfo->find('li')[6]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[4]->find('span')) == 1) {
                $tmpManga['cate'] = $ulInfo->find('li')[4]->innertext();
                $tmpManga['cate'] = substr($tmpManga['cate'], strrpos($tmpManga['cate'], '>') + 1);
                $tmpManga['cate'] = str_replace('&nbsp;', '', $tmpManga['cate']);
                $tmpManga['cate'] = trim($tmpManga['cate']);
            } else $tmpManga['cate'] = $ulInfo->find('li')[4]->find('span')[1]->innertext();

            $tmpManga['description'] = $mangaPage->find('div[class=margin-top-10 manga-summary]')[0]->innertext();
            $tmpManga['description'] = trim($tmpManga['description']);

            $manga = Manga::where('name', 'like', '%' . $tmpManga['oriTitle'] . '%')->first();
            $listChap = $info->find('ul')[1]->find('ul')[0]->find('ul')[0]->find('a');
            if (!empty($manga)) {//$manga !=null
                //$this->comment('starting old ' . $manga->name);
                $lastest = $manga->chapters()->max('chapter_number');
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = '';
                    $numOfChap = '';
                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
                    } else {
                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
                    }
//              if (strcmp($lastest,$numOfChap)==0) break;
                    $existChap = $manga->chapters()->where('chapter_number', $numOfChap)->first();
                    if (isset($existChap)) continue;
                    $textImg = $this->getImageComic($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $manga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
//                $this->comment('chapter: '.$insertChap->chapter_number);
                }
                dd('done');
            } else {
                //$$manga=null
//            $this->comment('starting new'.$tmpManga['oriTitle']);
                $cate = Category::firstOrCreate([
                    'name' => $tmpManga['cate'],
                    'slug' => str_slug($tmpManga['cate'])
                ]);

                $insertManga = Manga::create([
                    'name' => $tmpManga['oriTitle'],
                    'slug' => str_slug($tmpManga['oriTitle']),
                    'poster' => $tmpManga['poster'],
                    'status' => $tmpManga['status'],
                    'description' => $tmpManga['description'],
                    'translator' => '',
                    'alias' => $tmpManga['alias'],
                    'view' => 1,
                ]);
                $insertManga->categories()->attach($cate);
                foreach ($ulInfo->find('li')[3]->find('a') as $item) {
                    $genre = $item->innertext();
                    $genre = trim($genre);
                    $insertGenre = Genre::firstOrCreate([
                        'name' => $genre,
                        'slug' => str_slug($genre)
                    ]);
                    $insertManga->genres()->attach($insertGenre);
                }
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = '';
                    $numOfChap = '';
                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
                    } else {
                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
                    }
                    $textImg = $this->getImageComic($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $insertManga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();

                }
                dd('done');
            }
        }
    }

    public function getImageComic($linkChap)
    {
        $chapPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net/' . $linkChap));
        $listImg = HtmlDomParser::str_get_html($chapPage->find('textarea[id=txtarea]')[0]->innertext());
        $textImg = '';
        foreach ($listImg->find('img') as $img) {
            $textImg = $textImg . $img->src . ',';
        }
        return $textImg;
    }

    public function getIndexComic(){
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://comicvn.net/'
        ]);
        $indexPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net/'));
        foreach ($indexPage->find('div[class=manga-list-1]')[0]->find('div[class=item col-md-6 item-2]') as $manga) {
            $mangaPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net'.$manga->find('a')[0]->href));
            $info = $mangaPage->find('div[class=manga-info-main]')[0];
            $tmpManga = [];
            $tmpManga['poster'] = $info->find('div[class=col-xs-3]')[0]->find('img')[0]->src;
            $tmpManga['oriTitle'] = $info->find('div[class=sub-bor]')[0]->find('h1')[0]->innertext();
            $tmpManga['oriTitle'] = trim($tmpManga['oriTitle']);
            $ulInfo = $info->find('div[class=col-xs-9]')[0]->find('ul')[0];
            $tmpManga['alias'] = '';
            $tmpManga['artist'] = '';
            $tmpManga['author'] = '';
            $tmpManga['status'] = '';
            $tmpManga['cate'] = '';
            if (sizeof($ulInfo->find('li')[2]->find('span')) == 1) {
                $tmpManga['alias'] = $ulInfo->find('li')[2]->innertext();
                $tmpManga['alias'] = substr($tmpManga['alias'], strrpos($tmpManga['alias'], '>') + 1);
                $tmpManga['alias'] = str_replace('&nbsp;', '', $tmpManga['alias']);
                $tmpManga['alias'] = trim($tmpManga['alias']);
            } else $tmpManga['alias'] = $ulInfo->find('li')[2]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[1]->find('span')) == 1) {
                $tmpManga['artist'] = $ulInfo->find('li')[1]->innertext();
                $tmpManga['artist'] = substr($tmpManga['artist'], strrpos($tmpManga['artist'], '>') + 1);
                $tmpManga['artist'] = str_replace('&nbsp;', '', $tmpManga['artist']);
                $tmpManga['artist'] = trim($tmpManga['artist']);
            } else $tmpManga['artist'] = $ulInfo->find('li')[1]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[0]->find('span')) == 1) {
                $tmpManga['author'] = $ulInfo->find('li')[0]->innertext();
                $tmpManga['author'] = substr($tmpManga['author'], strrpos($tmpManga['author'], '>') + 1);
                $tmpManga['author'] = str_replace('&nbsp;', '', $tmpManga['author']);
                $tmpManga['author'] = trim($tmpManga['author']);
            } else $tmpManga['author'] = $ulInfo->find('li')[0]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[6]->find('span')) == 1) {
                $tmpManga['status'] = $ulInfo->find('li')[6]->innertext();
                $tmpManga['status'] = substr($tmpManga['status'], strrpos($tmpManga['status'], '>') + 1);
                $tmpManga['status'] = str_replace('&nbsp;', '', $tmpManga['status']);
                $tmpManga['status'] = trim($tmpManga['status']);
            } else $tmpManga['status'] = $ulInfo->find('li')[6]->find('span')[1]->innertext();

            if (sizeof($ulInfo->find('li')[4]->find('span')) == 1) {
                $tmpManga['cate'] = $ulInfo->find('li')[4]->innertext();
                $tmpManga['cate'] = substr($tmpManga['cate'], strrpos($tmpManga['cate'], '>') + 1);
                $tmpManga['cate'] = str_replace('&nbsp;', '', $tmpManga['cate']);
                $tmpManga['cate'] = trim($tmpManga['cate']);
            } else $tmpManga['cate'] = $ulInfo->find('li')[4]->find('span')[1]->innertext();

            $tmpManga['description'] = $mangaPage->find('div[class=margin-top-10 manga-summary]')[0]->innertext();
            $tmpManga['description'] = trim($tmpManga['description']);

            $manga = Manga::where('name', 'like', '%' . $tmpManga['oriTitle'] . '%')->first();
            $listChap = $info->find('ul')[1]->find('ul')[0]->find('ul')[0]->find('a');
            if (!empty($manga)) {//$manga !=null
                //$this->comment('starting old ' . $manga->name);
                $lastest = $manga->chapters()->max('chapter_number');
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = '';
                    $numOfChap = '';
                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
                    } else {
                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
                    }
                    for($char = 'A';$char<='Z';$char++){
                        $numOfChap = str_replace($char,'.'.(ord($char)-64),$numOfChap);
                    }
//              if (strcmp($lastest,$numOfChap)==0) break;
                    $existChap = $manga->chapters()->where('chapter_number', $numOfChap)->first();
                    if (isset($existChap)) continue;
                    $textImg = $this->getImageComic($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $manga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
//                $this->comment('chapter: '.$insertChap->chapter_number);
                }
            } else {
                //$$manga=null
//            $this->comment('starting new'.$tmpManga['oriTitle']);
                $cate = Category::firstOrCreate([
                    'name' => $tmpManga['cate'],
                    'slug' => str_slug($tmpManga['cate'])
                ]);

                $insertManga = Manga::create([
                    'name' => $tmpManga['oriTitle'],
                    'slug' => str_slug($tmpManga['oriTitle']),
                    'poster' => $tmpManga['poster'],
                    'status' => $tmpManga['status'],
                    'description' => $tmpManga['description'],
                    'translator' => '',
                    'alias' => $tmpManga['alias'],
                    'view' => 1,
                ]);
                $insertManga->categories()->attach($cate);
                foreach ($ulInfo->find('li')[3]->find('a') as $item) {
                    $genre = $item->innertext();
                    $genre = trim($genre);
                    $insertGenre = Genre::firstOrCreate([
                        'name' => $genre,
                        'slug' => str_slug($genre)
                    ]);
                    $insertManga->genres()->attach($insertGenre);
                }
                for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                    $nameChap = '';
                    $numOfChap = '';
                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
                    } else {
                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
                    }
                    for($char = 'A';$char<='Z';$char++){
                        $numOfChap = str_replace($char,'.'.($char-64),$numOfChap);
                    }
                    $textImg = $this->getImageComic($listChap[$i]->href);
                    $insertChap = new \App\Chapter();
                    $insertChap->name = $nameChap;
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $numOfChap;
                    $insertManga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();

                }
            }
        }
        dd(done);
    }
}
