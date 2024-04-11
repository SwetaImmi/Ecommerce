<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        \App\Console\Commands\SendEmail::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('send:email')->everyFifteenMinutes();
        $schedule->command('send:email')->everyMinute();
        // ->dailyAt('16:07')->timezone('Asia/Kolkata');
        // $schedule->command('email:send')->daily(); // Runs the command daily
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
