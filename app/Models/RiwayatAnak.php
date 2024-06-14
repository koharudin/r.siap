<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAnak extends Model
{
    public $table  = 'riwayat_anak';

    public function obj_pegawai(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
    public function obj_jenis_kelamin(){
        return $this->hasOne(JenisKelamin::class,'id','jenis_kelamin');
    }
    public function obj_status_anak(){
        return $this->hasOne(StatusAnak::class,'id','status_keluarga');
    }
    public $dates = ['birth_date'];
    protected $casts = [
        'birth_date' => 'datetime:Y-m-d',
    ];
}
