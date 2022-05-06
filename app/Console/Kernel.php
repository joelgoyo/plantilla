<?php

namespace App\Console;

use Illuminate\Console\Command;
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
        Commands\BonoCartera::class,
        Commands\startPayRentabilidad::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('bono:cartera')->monthly();
        $schedule->command('start:payrentabilidad')->cron('0 23 * * 0');
        $schedule->command('pagar:rentabilidad')->days([1,2,3,4,5])->at('00:00');
        $schedule->command('capital:sumRentabilidad')->monthly();
        $schedule->command('checkstatus:order')->hourly();
        $schedule->command('checkstatus:withdraw')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}