<?php

namespace App\Console;

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
        Commands\Inspire::class,
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
        $schedule->exec('php '.base_path('artisan queue:listen --timeout=1'))->everyMinute()->appendOutputTo(base_path('schedule_output.txt'));
        $schedule->exec('mv '.base_path('schedule_output.txt').' '.base_path('schedule_logs/'.\Carbon\Carbon::now()->toTimeString().'.txt'))->hourly();
    }
}
