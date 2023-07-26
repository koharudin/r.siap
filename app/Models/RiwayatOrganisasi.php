<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatOrganisasi extends Model
{
    public $table  = 'riwayat_organisasi';
    public $dates = ['awal', 'akhir'];
}
