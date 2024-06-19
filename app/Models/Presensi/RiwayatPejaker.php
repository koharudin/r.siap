<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use Illuminate\Database\Eloquent\Model;

class RiwayatPejaker extends Model
{

     public $connection = 'db_presensi';
     public $table  = 'tbl_pejaker';
     public $primaryKey = 'id';

     public function obj_employee()
     {
          return $this->hasOne(EmployeePresensi::class, 'nomor_pekerja', 'no_pekerja');
     }

     public function scopeOrderTanggal($query)
     {
          $query->orderBy('tgl_pejaker', 'desc');
     }

     const list_alasan = [
          '1' => 'Datang Terlambat',
          '2' => 'Pulang Lebih Cepat',
          '3' => 'Datang Terlambat & Pulang Lebih Cepat'
     ];

     const list_jenis = [
          'dinas' => 'DINAS',
          'non dinas' => 'NON DINAS'
     ];
}
