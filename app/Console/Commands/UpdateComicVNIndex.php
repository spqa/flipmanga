<?php

namespace App\Console\Commands;

use App\Category;
use App\Genre;
use App\Manga;
use App\TypeImg;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateComicVNIndex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:comicVNIndex';

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
        $this->getIndexComic();
    }

    public function getIndexComic()
    {
        $indexPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net/'));
        foreach ($indexPage->find('div[class=manga-list-1]')[0]->find('div[class=item col-md-6 item-2]') as $manga) {
            $this->getMangaFromLink('http://comicvn.net' . $manga->find('a')[0]->href);
        }
    }

    //Lấy ảnh từ link

    public function getMangaFromLink($mangaLink)
    {
        $type = TypeImg::firstOrCreate([
            'prefix' => 'http://comicvn.net/'
        ]);
        $mangaPage = HtmlDomParser::str_get_html(file_get_contents($mangaLink));
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

        $manga = Manga::where('name', $tmpManga['oriTitle'])->first();
        $listChap = $info->find('ul')[1]->find('ul')[0]->find('ul')[0]->find('a');
        if (!empty($manga)) {//$manga !=null
            $this->comment('ComicVN starting old ' . $manga->name);
            for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                $nameChap = $listChap[$i]->innertext();
//                $numOfChap = '';
//                try {
//                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
//                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
//                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
//                    } else {
//                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
//                    }
//                    for ($char = 'A'; $char <= 'Z'; $char++) {
//                        $numOfChap = str_replace($char, '.' . (ord($char) - 64), $numOfChap);
//                    }
//                } catch (\Exception $exception) {
//                    Log::error($exception->getMessage());
//                    Log::error($exception->getTraceAsString());
//                    continue;
//                }
//                $numOfChap = str_replace(',', '.', $numOfChap);
                $existChap = $manga->chapters()->where('name', $nameChap)->first();
                if (isset($existChap)) continue;
                $textImg = $this->getImageComic($listChap[$i]->href);
                if (strpos($textImg,'http') ===false && !empty($textImg) && $manga->chapters()->count()==0) {
                    $this->comment('deleted');
                    $manga->forceDelete();
                    break;
                }
                $insertChap = new \App\Chapter();
                try {
//                    $insertChap->name = empty($nameChap) ? $manga->name . ' ' . $numOfChap : $nameChap;
                    $insertChap->name = $nameChap;
                    $insertChap->slug = str_slug($nameChap);
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $manga->chapters()->count()+1;
                    $manga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
                    $this->comment('chapter: ' . $insertChap->name);
                } catch (\Exception $exception) {
                    Log::error($exception->getMessage());
                    Log::error($exception->getTraceAsString());
                    continue;
                }
            }
        } else {
            //$$manga=null
            $this->comment('ComicVN starting new' . $tmpManga['oriTitle']);
            $cate = Category::firstOrCreate([
                'name' => $tmpManga['cate'],
                'slug' => str_slug($tmpManga['cate']),
                'avatar' => '',
                'description' => ''
            ]);
            $imageName = str_slug($tmpManga['oriTitle'] . '-' . time()) . '.jpg';
            try {
                Image::make($tmpManga['poster'])->save(storage_path('app/public/images/poster/' . $imageName));
            } catch (\Exception $exception) {
                $imageName = 'placeholder.png';
                Log::error($exception->getMessage());
                Log::error($exception->getTraceAsString());
            }
            $insertManga = Manga::create([
                'name' => $tmpManga['oriTitle'],
                'slug' => str_slug($tmpManga['oriTitle']),
                'poster' => url('images/poster/' . $imageName),
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
                $nameChap = $listChap[$i]->innertext();
//                $numOfChap = '';
//                try {
//                    if (strrpos($listChap[$i]->innertext(), ':') !== false) {
//                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[1]);
//                        $numOfChap = trim(explode(' ', explode(':', $listChap[$i]->innertext())[0])[1]);
//                    } else {
//                        $numOfChap = trim(explode(' ', $listChap[$i]->innertext())[1]);
//                    }
//                    for ($char = 'A'; $char <= 'Z'; $char++) {
//                        $numOfChap = str_replace($char, '.' . (ord($char) - 64), $numOfChap);
//                    }
//                } catch (\Exception $exception) {
//                    Log::error($exception->getMessage());
//                    Log::error($exception->getTraceAsString());
//                    continue;
//                }
//                $numOfChap = str_replace(',', '.', $numOfChap);
                $textImg = $this->getImageComic($listChap[$i]->href);
                if (strpos($textImg,'http') ===false && !empty($textImg) && $insertManga->chapters()->count()==0) {
                    $this->comment('deleted');
                    $insertManga->forceDelete();

                    break;
                }
                $insertChap = new \App\Chapter();
                try {
//                    $insertChap->name = empty($nameChap) ? $insertManga->name . ' ' . $numOfChap : $nameChap;
                    $insertChap->name = $nameChap;
                    $insertChap->slug = str_slug($nameChap);
                    $insertChap->img = $textImg;
                    $insertChap->chapter_number = $insertManga->chapters()->count()+1;
                    $insertManga->chapters()->save($insertChap);
                    $insertChap->typeImg()->associate($type);
                    $insertChap->save();
                    $this->comment('chapter: ' . $insertChap->name);
                } catch (\Exception $exception) {
                    Log::error($exception->getMessage());
                    Log::error($exception->getTraceAsString());
                    continue;
                }
            }
        }
    }

    //Lấy truyện từ link

    public function getImageComic($linkChap)
    {
        try {
            $chapPage = HtmlDomParser::str_get_html(file_get_contents('http://comicvn.net/' . $linkChap));
            $listImg = HtmlDomParser::str_get_html($chapPage->find('textarea[id=txtarea]')[0]->innertext());
            $textImg = '';
            foreach ($listImg->find('img') as $img) {
                $textImg = $textImg . $img->src . ',';
            }
            return $textImg;
        } catch (\Exception $exception) {
            return '';
        }
    }

}
