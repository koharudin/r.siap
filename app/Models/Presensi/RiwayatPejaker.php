<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatPejaker extends Model
{
     public $table  = 'presensi.riwayat_pejaker';
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
          $query->orderBy('tgl_pejaker', 'desc');
     }
     
     const list_alasan =[
          '1'=>'Datang Terlambat',
          '2'=>'Pulang Lebih Cepat',
          '3'=>'Datang Terlambat & Pulang Lebih Cepat'
     ];

     const list_jenis = [
          'dinas' => 'DINAS',
          'non dinas'=>'NON DINAS'
     ];
}
