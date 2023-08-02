<?php

use App\Admin\Forms\Profile\FormRiwayatPendidikan;
use App\Admin\Forms\Requests\FormRiwayatPendidikan as RequestsFormRiwayatPendidikan;
use App\Models\Employee;
use App\Models\RiwayatUsulan;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/
Artisan::command('cek', function () {
    $usulan = RiwayatUsulan::find(20);
    $f = new RequestsFormRiwayatPendidikan();
    $f->onTerima($usulan);
    return;
    $this->info("done");
})->purpose('Display an inspiring quote');
Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
Artisan::command('bup', function () {
    $ls = Employee::with(['obj_riwayat_jabatan','obj_riwayat_jabatan.obj_tipe_jabatan','obj_riwayat_jabatan.obj_jabatan_fungsional','obj_riwayat_jabatan.obj_jabatan_struktural'])->get()->all();
    foreach($ls as $e){
        $this->info("Pegawai ID : ".$e->id);
        $this->info("NIP : ".$e->nip_baru);
        $this->info("Pegawai > ".$e->first_name);
        //$bup = $e->getBup();
        //$this->info($bup);
        $this->info($e->setTanggalPensiun());
    }
})->purpose('Display an inspiring quote');