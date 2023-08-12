<?php

use App\Admin\Forms\Profile\FormRiwayatPendidikan;
use App\Admin\Forms\Requests\FormRiwayatPendidikan as RequestsFormRiwayatPendidikan;
use App\Models\Administrator;
use App\Models\Employee;
use App\Models\RiwayatAnak;
use App\Models\RiwayatNikah;
use App\Models\RiwayatOrangTua;
use App\Models\RiwayatUsulan;
use Encore\Admin\Facades\Admin;
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
Artisan::command('demo', function () {
    $this->info("Random");
    $faker = Faker\Factory::create();
    $ls = Employee::all();
    $user = Administrator::find(1);
    $user->password_x = md5("demo");
    $user->save();
    foreach($ls as $e){
        $e->first_name = $faker->name;
        $e->email_kantor = $faker->email;
        $e->email = $faker->email;
        $e->birth_date = $faker->date;
        $e->karpeg = $faker->numberBetween(4500,4900);
        $e->nik = $faker->numberBetween(2000000000,21000000000);
        $e->no_hp = "0821-1292-".$faker->numberBetween(1000,4444);
        $e->alamat = $faker->paragraph(1);
        $e->save();
    }
    $ls = RiwayatAnak::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->save();
    }

    $ls = RiwayatOrangTua::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->birth_date = $faker->date;
        $e->save();
    }
    $ls = RiwayatNikah::all();
    foreach($ls as $e){
        $e->name = $faker->name;
        $e->birth_date = $faker->date;
        $e->buku_nikah = "NKH/".$faker->numberBetween(2000,3000);
        $e->save();
    }
});
Artisan::command('cek', function () {
    $credentials['username'] = 'muhammad.zahrudin@anri.go.id';
    $user = config('admin.database.users_model')::whereHas('obj_employee',function($q)use($credentials){
        $q->where('email_kantor',$credentials['username']);
    })->get()->first();
    dd($user);
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