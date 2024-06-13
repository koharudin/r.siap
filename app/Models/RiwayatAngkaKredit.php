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
}
