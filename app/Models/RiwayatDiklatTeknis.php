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
}
