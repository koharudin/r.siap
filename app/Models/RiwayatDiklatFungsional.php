<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatFungsional extends Model
{
    public $table  = 'riwayat_diklat_teknis';

    public function scopeDiklatTeknis($query){
        $query->where('jenis_diklat',1);
    }
}
