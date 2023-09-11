<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKursus extends Model
{
    public $table = 'riwayat_kursus';
    
    public $dates = ['tgl_mulai', 'tgl_selesai'];

    public function obj_id()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

    public function obj_jenis()
    {
        return $this->hasOne(DiklatSiasn::class, 'id_siasn', 'jenis_diklat_siasn');
    }
}
