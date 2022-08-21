<?php

namespace App\Console\Commands;

use App\Jobs\StatisticsJob;
use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;

class UpdateStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-statistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save and update Statistic Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $job = app(StatisticsJob::class);

        dispatch(($job)->onQueue('high'));

        return 1;
    }
}
