<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class cronDue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'due:cron';

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
     * @return mixed
     */
    public function handle()
    {
        DB::table('billings')->insert(['bill_status'=>'0']);
        $this->info('due:Cron Cummand Run successfully!');

    }
}
