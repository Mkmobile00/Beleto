<?php

namespace App\Console;
use App\Jobs\ExchangeRateSetup;
use App\Jobs\UpdateSubscription;
use App\Events\TestTranscodeEvent;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->call(new TestTranscodeEvent())->everyMinute();
        $schedule->call((new ExchangeRateSetup))->everyMinute();
        $schedule->call(new UpdateSubscription())->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
