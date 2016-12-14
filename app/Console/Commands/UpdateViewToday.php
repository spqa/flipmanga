<?php

namespace App\Console\Commands;

use App\Manga;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class UpdateViewToday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'updateToday';

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

        $list = collect(Redis::zrevrange('manga.trending.day', 0, 16))->map(function ($id) {
            return Manga::find($id);
        });
        if ($list->count() < 6) {
            Manga::orderBy('view', 'desc')->take(6)->get()->each(function ($item) use ($list) {
                $list->push($item);
            });
        }
        Cache::put('manga.list.day', $list->unique('id'), 35);
    }
}
