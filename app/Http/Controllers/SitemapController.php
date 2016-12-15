<?php

namespace App\Http\Controllers;

use App\Genre;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class SitemapController extends Controller
{
    public function sitemap(){
        $sitemap = App::make("sitemap");
        // get all products from db (or wherever you store them)
        $mangas = DB::table('mangas')->orderBy('updated_at', 'desc')->get();

        // counters
        $counter = 0;
        $sitemapCounter = 0;

        // add every product to multiple sitemaps with one sitemapindex
        foreach ($mangas as $p)
        {
            if ($counter == 3000)
            {
                // generate new sitemap file
                $sitemap->store('xml','sitemap-'.$sitemapCounter);
                // add the file to the sitemaps array
                $sitemap->addSitemap(url('sitemap-'.$sitemapCounter.'.xml'));
                // reset items array (clear memory)
                $sitemap->model->resetItems();
                // reset the counter
                $counter = 0;
                // count generated sitemap
                $sitemapCounter++;
            }

            // add product to items array
            $sitemap->add(route('manga',['manga'=>$p->slug]), $p->updated_at, 0.9, 'daily');
            // count number of elements
            $counter++;
        }

        // you need to check for unused items
        if (!empty($sitemap->model->getItems()))
        {
            // generate sitemap with last items
            $sitemap->store('xml','sitemap-'.$sitemapCounter);
            // add sitemap to sitemaps array
            $sitemap->addSitemap(url('sitemap-'.$sitemapCounter.'.xml'));
            // reset items array
            $sitemap->model->resetItems();
        }

        $sitemap->add(route('home'),Carbon::now(),1.0,'always');
        $sitemap->add(route('manga.full'),Carbon::now(),1.0,'daily');
        $sitemap->add(route('manga.latest'),Carbon::now(),1.0,'always');
        $sitemap->add(route('genre'),Carbon::now(),1.0,'daily');
        foreach (Genre::all() as $genre){
            $sitemap->add(route('genre',['genre'=>$genre->slug]),Carbon::now(),1.0,'always');

        }
        $sitemap->store('xml','sitemap-index');
        $sitemap->addSitemap(url('sitemap-index.xml'));
        // generate new sitemapindex that will contain all generated sitemaps above
        $sitemap->store('sitemapindex','sitemap');
    }

}
