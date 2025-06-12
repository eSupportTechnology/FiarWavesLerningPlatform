<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\DailyIncomeCommand::class,
    ];


    protected function schedule(Schedule $schedule): void
    {
        // Schedule daily income task here (example below)
        $schedule->command('app:daily-income-command')->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
