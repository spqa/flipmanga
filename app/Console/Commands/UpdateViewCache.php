<?php

namespace App\Console\Commands;

use App\Manga;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class UpdateViewCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateView';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update view from cache and flush cache';

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
        $list=Redis::zrange('manga.view',0,-1,'withscores');
        Manga::whereIn('id',array_keys($list))->chunk(200,function ($mangas)use($list){
            foreach ($mangas as $manga){
                $manga->timestamps=false;
                $manga->view=$manga->view+$list[$manga->id];
                $manga->save();
            }
        });
        Redis::del('manga.view');

    }
}
