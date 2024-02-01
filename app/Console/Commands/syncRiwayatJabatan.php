<?php

namespace App\Console\Commands;

use App\Models\Employee;
use App\Models\StatusJabatan;
use Illuminate\Console\Command;

class syncRiwayatJabatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:jabatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi Riwayat Terakhir Jabatan ke tabel Pegawai';

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
        $employees = Employee::whereHas('obj_riwayat_jabatan', function ($query) {
            $query->where('status_jabatan_id', StatusJabatan::DEFINITIF);
        })->with(['obj_riwayat_jabatan'])->get();
        $this->info("mulai " . $employees->count());
        $employees->each(function ($employee, $i) {
            $this->info("processing index#" . $i);
            $last = $employee->obj_riwayat_jabatan->last();
            if ($last) {
                $employee->last_riwayat_jabatan_id = $last->id;
                $employee->save();
            }
        });
        $this->info("selesai");
        return 0;
    }
}
