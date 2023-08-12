<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatCuti extends Model
{
     public $table  = 'presensi.riwayat_cuti';
     public $primaryKey = 'id';

     public function obj_employee(){
          return $this->hasOne(Employee::class,'id','employee_id');
     }
     public function obj_detail_jenis_cuti(){
          return $this->hasOne(DetailJenisCuti::class,'id','id_detail_jenis_cuti');
     }
}
