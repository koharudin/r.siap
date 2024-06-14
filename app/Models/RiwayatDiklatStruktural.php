<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatStruktural extends Model
{
    public $table  = 'riwayat_diklat_struktural';

    public $dates = ['tgl_mulai', 'tgl_selesai', 'tgl_sttpp'];
    protected $casts = [
        'tgl_mulai' => 'datetime:Y-m-d', 'tgl_selesai' => 'datetime:Y-m-d', 'tgl_sttpp' => 'datetime:Y-m-d'
    ];
}
