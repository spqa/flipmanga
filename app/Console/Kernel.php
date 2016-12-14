<?php

namespace App\Console;

use App\Console\Commands\UpdateTrending;
use App\Console\Commands\UpdateViewCache;
use App\Console\Commands\UpdateViewToday;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Redis;

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
        UpdateViewToday::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    $schedule->command('updateView')->everyMinute();
    $schedule->command('updateTreding')->everyTenMinutes();
    $schedule->command('updateToday')->everyThirtyMinutes();
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
