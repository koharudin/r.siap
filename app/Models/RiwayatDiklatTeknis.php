<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatTeknis extends Model
{
    public $table  = 'riwayat_diklat_teknis';
    public function scopeDiklatTeknis($query){
        $query->where('jenis_diklat',1);
    }
    
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
