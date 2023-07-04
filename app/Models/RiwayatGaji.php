<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatGaji extends Model
{
    public $table  = 'riwayat_gaji';

    public function objPangkat(){
        return $this->hasOne(Pangkat::class,'id','pangkat_id');
    }
    public function objJenisKenaikanGaji(){
        return $this->hasOne(JenisKenaikanGaji::class,'id','jenis_kenaikan');
    }
    
}
