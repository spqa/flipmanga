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

    $allmanga = \App\Manga::skip(2136)->take(3000)->get();
//    dd($allmanga->first());
    foreach ($allmanga as $manga) {
        $allChapter = DB::connection('sqlsrv')->table('CHAPTER')->where('MANGAID', $manga->cloudid)->get();
        $allChapter = $allChapter->unique('TITLE');
//        dd($allChapter);
        foreach ($allChapter as $chapter) {
            $imgs = DB::connection('sqlsrv')->table('IMG')->where('CHAPID', $chapter->ID)->get();
            $text_img = '';
            foreach ($imgs as $img) {
                $img = str_replace("//i1.heymanga.me/", "", $img->URL);
                $text_img .= $img . ',';
            }
            $chapter1 = new \App\Chapter([
                'name' => $chapter->TITLE,
                'img' => $text_img
            ]);
            $manga->chapters()->save($chapter1);
            $this->comment($chapter->TITLE);
        }
    }
});
Artisan::command('updateImage', function () {
    $username = 'spqa';
    $password = 'CQDG6tQUwBN8';

    $mangas = \App\Manga::skip(458)->take(3000)->get();
    foreach ($mangas as $manga) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://myanimelist.net/api/manga/search.xml?q=' . $manga->name);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        $output = curl_exec($ch);

//        $info = curl_getinfo($ch);
//    dd($info);
        curl_close($ch);
        if (!empty($output)) {
            $xml = simplexml_load_string($output);
            $json = json_encode($xml);
            $array = json_decode($json);
//        dd($array);
        } else {
            $array = false;
        }
        if ($array != false) {

            $this->comment($manga->name . ' started');

            foreach (($array->entry) as $values) {
                if ($array->entry instanceof stdClass) {
                    $values = $array->entry;
                }
//                dd(\Carbon\Carbon::parse($values->start_date));

                if ($values->type == 'Manga') {
                    $manga->eng_name = $values->english instanceof stdClass ? '' : $values->english;
                    $manga->description = $values->synopsis instanceof stdClass ? '' : $values->synopsis;
                    $manga->status = $values->status;
                    $manga->alias = $values->synonyms instanceof stdClass ? '' : $values->synonyms;
                    $manga->ani_poster = $values->image;
                    $manga->save();
                    try {
                        $manga->released_at = ($values->start_date instanceof stdClass) ? '' : $values->start_date;
                        $manga->save();
                    } catch (Exception $ex) {
                        $this->comment($manga->name . ' date error!');
                    }
                }
                $this->comment($manga->name . ' updated');
                break;
            }

        }
    }
}

);

Artisan::command('deleteDupImg', function () {
    \App\Chapter::chunk(300, function ($chapters) {
        foreach ($chapters as $chapter) {
            $array_img = preg_split("/[\s,]+/", $chapter->img, -1, PREG_SPLIT_NO_EMPTY);
            $array_unique = array_unique($array_img);

            $text = '';
            foreach ($array_unique as $img) {
                $text .= $img . ',';
            }
            $chapter->img = $text;
//            dd($chapter->img);
            $chapter->save();
            $this->comment($chapter->id);
//            dd($array_img);
        }
    });
});

//Artisan::command()
Artisan::command('chapterNumber', function () {
    \App\Chapter::chunk(300, function ($chapters) {
        foreach ($chapters as $chapter) {
            $temp=$chapter->name;
        $number_array=explode(' ',$temp);
        $number=array_pop($number_array);
        try{
            $chapter->chapter_number=$number;
        }catch(Exception $ex){
            $this->comment($chapter->name.' error!');
        }
        if (is_double($number)) {
            $chapter->save();
        }
            $this->comment($chapter->name.' updated');
        }
    });
});

Artisan::command('updateGenre',function (){
//    $mangasCloud=DB::connection('sqlsrv')->table('MANGA')->get();
    $mangas=\App\Manga::all();
    foreach ($mangas as $manga){
        $cloud=DB::connection('sqlsrv')->table('MANGA')->where('TITLE',$manga->name)->first();
//        dd($cloud);
        $genres=$cloud->genre;
        if (!empty($genres)) {
            $array_genre = preg_split("/,\s/", $genres, -1, PREG_SPLIT_NO_EMPTY);
//        dd($array_genre);
//        $genres_id=\App\Genre::whereIn('name',$array_genre)->get(['id']);
            $genres_id = [];
            foreach ($array_genre as $item) {
                $id = \App\Genre::firstOrCreate([
                    'name' => $item,
                    'slug' => str_slug($item),
//                'avatar'=>'',
//                'description'=>''
                ])->id;
                array_push($genres_id, $id);
            }
            $manga->genres()->sync($genres_id);
            $this->comment($manga->name);
        }
    }
});


