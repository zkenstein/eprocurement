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
        Commands\CreateKontrak::class,
        Commands\CreateBeritaAcara::class,
        Commands\CekValiditasHarga::class
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
//        $schedule->exec('php '.base_path('artisan queue:work --timeout=10'))->everyMinute()->appendOutputTo(base_path('schedule_output.txt'));
        $schedule->command('create:kontrak')->everyMinute()->appendOutputTo(base_path('cek_pemenang_output.txt'));
        $schedule->exec('mv '.base_path('cek_pemenang_output.txt').' '.base_path('cron_logs/'.\Carbon\Carbon::now()->toTimeString().'cek_pemenang_output.txt'))->hourly();
        $schedule->command('cek:validitas_harga')->everyMinute()->appendOutputTo(base_path('cek_validitas_output.txt'));
        $schedule->exec('mv '.base_path('cek_validitas_output.txt').' '.base_path('cron_logs/'.\Carbon\Carbon::now()->toTimeString().'cek_validitas_output.txt'))->hourly();
    }
}
