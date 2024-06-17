<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAngkaKredit extends Model
{
    public $table  = 'riwayat_angkakredit';
    public function obj_pangkat(){
        return $this->hasOne(Pangkat::class,'id','pangkat_id');
    }
    public function obj_unit_kerja(){
        return $this->hasOne(UnitKerja::class,'id','unit_kerja_id');
    }

    public $dates = ['tgl_sk','dt_awal_penilaian','dt_akhir_penilaian','tmt_pak'];
    protected $casts = [
        'tgl_sk' => 'datetime:Y-m-d','dt_awal_penilaian' => 'datetime:Y-m-d','dt_akhir_penilaian' => 'datetime:Y-m-d','tmt_pak' => 'datetime:Y-m-d'
    ];

}
