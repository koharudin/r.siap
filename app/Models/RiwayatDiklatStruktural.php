<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatStruktural extends Model
{
    public $table  = 'riwayat_diklat_struktural';

    public $dates = ['tgl_mulai', 'tgl_selesai'];
}
