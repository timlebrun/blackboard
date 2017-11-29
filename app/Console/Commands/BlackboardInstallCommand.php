<?php

namespace App\Console\Commands;

use App\Models\Blackboard\Ticket;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BlackboardInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blackboard:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrates, seeds and setups everything.';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info('Migrating...');
        Artisan::call('migrate');
        $this->info('Installing...');
        Artisan::call('db:seed');
        $this->info('Indexing...');
        Artisan::call('scout:mysql-index', [Ticket::class]);

        $this->line('');
        $this->info('Done !');
    }
}
