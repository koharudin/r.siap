<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAnak extends Model
{
    public $table  = 'riwayat_anak';

    public function obj_jenis_kelamin(){
        return $this->hasOne(JenisKelamin::class,'id','jenis_kelamin');
    }
}
