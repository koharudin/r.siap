<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPensiun extends Model
{
    public $table  = 'riwayat_pensiun';
    public $dates = ['tgl_pensiun', 'tmt_pensiun'];
}
