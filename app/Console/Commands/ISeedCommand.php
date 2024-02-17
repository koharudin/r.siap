<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class ISeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iseedcust:alltables';

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
    public function handle3()
    {
        $tables = [
            'admin_menu'
        ];
        $this->call('iseed', [
            'tables' => join(",", $tables),
            '--classnameprefix' => "Customized",
            '--force' => true
        ]);
    }
    public function handle()
    {
        $this->info("generated iseed..");
        $tables = DB::connection()->getDoctrineSchemaManager()->listTableNames();
        foreach ($tables as $table) {
            $this->info($table);

            $this->call('iseed', [
                'tables' => $table,
                '--classnameprefix' => "Customized",
                '--force' => true
            ]);
        }
        return 0;
    }
}
