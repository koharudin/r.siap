<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKursus extends Model
{
    public $table  = 'riwayat_kursus';
    
    public $dates = ['tgl_mulai', 'tgl_selesai'];
}
