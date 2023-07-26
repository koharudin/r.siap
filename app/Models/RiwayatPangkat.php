<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    public $table  = 'riwayat_pangkat';
    const SK_CPNS = 1;
    const SK_PNS = 2;
    public function obj_pangkat(){
        return $this->hasOne(Pangkat::class,'id','pangkat_id');
    }
    public function obj_jenis_kenaikan_pangkat(){
        return $this->hasOne(JenisKP::class,'id','jenis_kp');
    }

    protected $dates = ['tmt_pangkat','tgl_sk'];
}
