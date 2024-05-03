<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use Exception;

class SyncBUP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:bup';

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
		$this->info("bup");
		$ls = Employee::get();
		$this->info("Total : ".$ls->count());
		$ls->each(function($e,$i){
			$this->info("employee #".$i);
			try {
				$e->setTanggalPensiun();
			}
			catch(Exception $fe){
				$this->error("Gagal Set Tanggal Pensiun : ".$e->nip_baru);
				$this->info($fe->getMessage());
			}
			$e->save();
		});
        return 0;
    }
}
