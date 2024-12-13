<?php

namespace App\Console\Commands;

use App\Models\UnitKerja;
use Illuminate\Console\Command;

class sync_riwayatjabatan_unitkerja extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:unitkerja_riwayat_jabatan';

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
        $list_unitkerja = UnitKerja::with(["list_riwayat_jabatan"=>function($query){
            $query->where(function($query){
                $query->where("tipe_jabatan_id",1);
                $query->orWhere("tipe_jabatan_id",6);
            });
        }])->get();
        $list_unitkerja->each(function($unitkerja){
            $this->info("Sync ". $unitkerja->name);
            //$this->info($unitkerja);
            $last = $unitkerja->list_riwayat_jabatan->last();
            if($last){
                $last->load("obj_employee");
                $unitkerja->pejabat_nip = $last->obj_employee->nip_baru;
                $unitkerja->pejabat_nama = $last->obj_employee->first_name;
                $unitkerja->pejabat_jabatan = $last->nama_jabatan;
                $unitkerja->save();
            }
        });
        return 0;
    }
}
