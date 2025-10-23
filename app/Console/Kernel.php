<?php

namespace App\Console;

use App\Console\Commands\Expiration;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule your commands here
        $schedule->command('expire')->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected $commands=[
        Expiration::class
        


    ];
}
