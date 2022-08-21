<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseCreateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates a new database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $database = env('DB_DATABASE', false);

        if (!$database) {
            $this->info('Skipping creation of database as env(DB_DATABASE) is empty');
            return 0;
        }

        try {
            Schema::createDatabase($database);

            $this->info("Successfully created {$database} database");
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}
