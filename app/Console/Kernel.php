<?php

namespace App\Console;

use App\Console\Commands\UpdateChapter;
use App\Console\Commands\UpdateMangaReader;
use App\Console\Commands\UpdateOldMangareader;
use App\Console\Commands\UpdateSitemap;
use App\Console\Commands\UpdateTrending;
use App\Console\Commands\UpdateViewCache;
use App\Console\Commands\UpdateViewToday;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        UpdateViewCache::class,
        UpdateTrending::class,
        UpdateViewToday::class,
        UpdateSitemap::class,
        UpdateChapter::class,
        UpdateMangaReader::class,
        UpdateOldMangareader::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('updateView')->everyMinute();
        $schedule->command('updateTrending')->everyTenMinutes();
        $schedule->command('updateToday')->everyThirtyMinutes();
        $schedule->command('sitemap')->hourly();
//        $schedule->command('update:Chapter')->name('change1.1')->everyTenMinutes()->withoutOverlapping();
        $schedule->command('update:mangareader')->name('mangareader1')->everyMinute()->withoutOverlapping();
        $schedule->command('update:old')->name('mangareader1.old')->everyThirtyMinutes()->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
