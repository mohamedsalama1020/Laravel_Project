<?php

namespace App\Console;

use App\Console\Commands\Expiration;
use App\Console\Commands\Notify;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule your commands here
        $schedule->command('expire')->everyMinute();

        $schedule->command('notify')->daily();
    }

    /**
     * Register the commands for the application.
     *
     */
   

   protected function commands(): void 
   {
     $this->load(__DIR__.'/Commands'); 

     require base_path('routes/console.php'); 

    }
}

