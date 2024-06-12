<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPotensiDiri extends Model
{
    public $table  = 'riwayat_potensi_diri';

    protected $fillable = ['tahun', 'tanggung_jawab', 'motivasi', 'minat'];
}
