<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
// Dinas LUAR
class RiwayatIzin extends Model
{
     public $table  = 'presensi.riwayat_izin';
     public $primaryKey = 'id';

     public function obj_employee(){
          return $this->hasOne(Employee::class,'id','employee_id');
     }
     public function employees()
     {
         return $this->hasMany(Employee::class,'employee_id');
     }
     public function scopeOrderTanggal($query){
          $query->orderBy('tgl_mulai','desc');
     }
}
