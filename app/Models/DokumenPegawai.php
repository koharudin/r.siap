<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DokumenPegawai extends Model
{
     public $table  = 'dokumen_pegawai';

     public function obj_klasifikasi_dokumen (){
          return $this->hasOne(KlasifikasiDokumen::class,'id','klasifikasi_id');
     }
     public function obj_pegawai (){
          return $this->hasOne(Employee::class,'simpeg_id','pk1');
     }
}
