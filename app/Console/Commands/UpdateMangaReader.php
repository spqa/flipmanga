<?php

namespace App\Console\Commands;

use App\Genre;
use App\Manga;
use App\TypeImg;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateMangaReader extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:mangareader';

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
        try {
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
                    $this->comment('Start update old manga :' . $manga->name);
                    $lastest = $manga->chapters()->max('chapter_number');
                    for ($i = sizeof($listChap) - 1; $i >= 0; $i--) {
                        $nameChap = trim(explode(':', $listChap[$i]->innertext())[0]);
                        $numOfChap = substr($nameChap, strlen($tmpManga['oriTitle']) + 1);
                        $temp = $manga->chapters()->whereChapterNumber($numOfChap)->first();
                        if (!empty($temp)) continue;
                        $textImg = $this->getImage($listChap[$i]->href);
                        $insertChap = new \App\Chapter();
                        $insertChap->name = $nameChap;
                        $insertChap->img = $textImg;
                        $insertChap->chapter_number = $numOfChap;
                        $manga->chapters()->save($insertChap);
                        $insertChap->typeImg()->associate($type);
                        $insertChap->save();
                        $this->comment('successfully update chapter: ' . $numOfChap);
                    }
                } else {
                    //$manga=null
                    $this->comment('Detect new manga! Start create new manga');
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
                        $this->comment('saved new chapter:' . $insertChap->name);

                    }
                }
            }
        } catch (\Exception $exception) {
            Log::error('Mangareader: '.$exception->getMessage());
        }


    }

    private function getImage($linkChap)
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
}
