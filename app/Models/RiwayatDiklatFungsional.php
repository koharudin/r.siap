<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatFungsional extends Model
{
    public $table  = 'riwayat_diklat_teknis';

    public function scopeDiklatFungsional($query){
        $query->where('jenis_diklat',2);
    }
    
    public $dates = ['tgl_mulai', 'tgl_selesai'];
}
