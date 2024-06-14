<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatRekamMedis extends Model
{
    public $table  = 'riwayat_rekammedis';
    public $dates = ['tgl_periksa'];
    protected $casts = [
        'tgl_periksa' => 'datetime:Y-m-d'
    ];
}
