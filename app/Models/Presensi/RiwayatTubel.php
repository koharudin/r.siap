<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatTubel extends Model
{
     //public $connection = 'pgsql_presensi';
     public $table  = 'presensi.riwayat_tubel';
     public $primaryKey = 'id';

     public function obj_employee()
     {
          return $this->hasOne(Employee::class, 'id', 'employee_id');
     }
     public function employees()
     {
          return $this->hasMany(Employee::class, 'employee_id');
     }
     public function scopeOrderTanggal($query)
     {
          $query->orderBy('tgl_mulai', 'desc');
     }
     
     public const list_jenis = [
          'Dalam Negeri'=>'Dalam Negeri',
          'Luar Negeri'=>'Luar Negeri',
     ];
}
