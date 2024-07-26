<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\RiwayatMutasi;
use Illuminate\Console\Command;

class CmdMutasi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:mutasi';

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
        $e = Employee::with(["obj_riwayat_mutasi"])->get();
        $e->each(function ($employee) {
            $this->info($employee->nip_baru);
            $last_mutasi = $employee->obj_riwayat_mutasi->last();
            if ($last_mutasi) {
                $employee->unit_id = $last_mutasi->satker_id_baru;
            }
            $employee->save();
        });
        $r = RiwayatMutasi::find(2986);
        $r->no_sk = rand(1, 100);
        $r->save();
        // return $e;
    }
}
