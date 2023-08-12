<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatLupaFinger extends Model
{
     public $table  = 'presensi.riwayat_lupa_finger';
     public $primaryKey = 'id';

     
     public function obj_employee(){
          return $this->hasOne(Employee::class,'id','employee_id');
     }
}
