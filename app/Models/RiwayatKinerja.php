<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatKinerja extends Model
{
    public $table  = 'riwayat_kinerja';

    public $dates  = ['tgl_penilaian'];
}
