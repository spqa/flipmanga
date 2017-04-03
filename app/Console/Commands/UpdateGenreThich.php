<?php

namespace App\Console\Commands;

use App\Genre;
use App\Manga;
use App\TypeImg;
use Illuminate\Console\Command;
use Sunra\PhpSimple\HtmlDomParser;

class UpdateGenreThich extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:thichgenre';

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
        if (!empty($manga)) {
            $tmpManga['genre'] = substr($tmpManga['genre'],0,strlen($tmpManga['genre'])-1);
            foreach (explode(',',$tmpManga['genre']) as $item) {
                if (empty($item)) continue;
                $insertGenre = Genre::firstOrCreate([
                    'name' => $item,
                    'slug' => str_slug($item)
                ]);
                $manga->genres()->attach($insertGenre);
            }
        }
        $this->comment('Update genre: ' . $tmpManga['oriTitle']);
    }
}
