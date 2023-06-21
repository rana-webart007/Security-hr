<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\GuardTrackingHistory;
use App\Http\Controllers\TrackingController;

class LogCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:cron';

    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Cron is working fine!");
        return url('security\cron-test');
        return Command::SUCCESS;
    }
}
