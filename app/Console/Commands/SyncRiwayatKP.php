<?php

namespace App\Console\Commands;

use App\Models\Employee;
use Illuminate\Console\Command;

class SyncRiwayatKP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:kp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi Riwayat Terakhir KP ke tabel Pegawai';

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
        $employees = Employee::with(['obj_riwayat_pangkat'])->get();
        $this->info("mulai " . $employees->count());
        $employees->each(function ($employee, $i) {
            $this->info("processing index#" . $i);
            $last = $employee->obj_riwayat_pangkat->last();
            if ($last) {
                $employee->last_riwayat_pangkat_id = $last->id;
                $employee->save();
            }
        });
        $this->info("selesai");
        return 0;
    }
}
