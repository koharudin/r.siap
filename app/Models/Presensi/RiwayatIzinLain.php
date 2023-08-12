<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatIzinLain extends Model
{
     public $table  = 'presensi.riwayat_izin_lain';
     public $primaryKey = 'id';

     public function obj_employee(){
          return $this->hasOne(Employee::class,'id','employee_id');
     }
     public function scopeOrderTanggal($query){
          $query->orderBy('tgl_mulai','desc');
     }
     public const list_jenis = [
          '1'=>'SAKIT TANPA SURAT DOKTER',
          '2'=>'ALASAN PENTING',
          '3'=>'IZIN PRIBADI'
     ];
}
