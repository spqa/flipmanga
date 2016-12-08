<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');
Artisan::command('sqlserver', function () {
//    $allManga = \Illuminate\Support\Facades\DB::connection('sqlsrv')->table('manga')->get();
//    foreach ($allManga as $manga) {
//        \App\Manga::create([
//            'name' => $manga->TITLE,
//            'slug' => str_slug($manga->TITLE),
//            'alias' => '',
//            'translator' => "",
//            'description' => "",
//            'view' => 1,
//            'status' => 'continue',
//            'poster' => $manga->POSTER,
//            'cloudid' => $manga->ID,
//        ]);
//        $this->comment($manga->TITLE);
//    }

    $allmanga=\App\Manga::skip(1366)->take(3000)->get();
//    dd($allmanga->first());
    foreach ($allmanga as $manga){
        $allChapter=DB::connection('sqlsrv')->table('CHAPTER')->where('MANGAID',$manga->cloudid)->get();
        $allChapter=$allChapter->unique('TITLE');
//        dd($allChapter);
        foreach ($allChapter as $chapter){
            $imgs=DB::connection('sqlsrv')->table('IMG')->where('CHAPID',$chapter->ID)->get();
            $text_img='';
            foreach ($imgs as $img){
                $img=str_replace("//i1.heymanga.me/","",$img->URL);
                $text_img.=$img.',';
            }
            $chapter1=new \App\Chapter([
                'name'=>$chapter->TITLE,
                'img'=>$text_img
            ]);
            $manga->chapters()->save($chapter1);
            $this->comment($chapter->TITLE);
        }
    }
});

//Artisan::command()
