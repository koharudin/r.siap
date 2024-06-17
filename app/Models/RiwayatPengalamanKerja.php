<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPengalamanKerja extends Model
{
    public $table  = 'riwayat_pengalaman_kerja';
    public $dates = ['tgl_kerja'];
    protected $casts = [
        'tgl_kerja' => 'datetime:Y-m-d'
    ];
}
