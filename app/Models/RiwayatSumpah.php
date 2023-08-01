<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RiwayatSumpah extends Model
{
    public $table  = 'riwayat_sumpah';

    public $dates  = ['tgl_sumpah'];
}
