<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyIncomeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-income-command';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate and update daily income.';


    /**
     * Execute the console command.
     */
    public function handle()
    {
        app(\App\Services\DailyIncomeService::class)->process();
        $this->info('Daily income has been credited to all eligible customers.');
    }

}
