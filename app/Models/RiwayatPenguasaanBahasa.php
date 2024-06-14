<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPenguasaanBahasa extends Model
{
    public $table  = 'riwayat_penguasaan_bahasa';

    public function obj_jenis_bahasa()
    {
        return $this->hasOne(JenisBahasa::class, 'id', 'jenis_bahasa');
    }
    public function obj_kemampuan_bicara()
    {
        return $this->hasOne(KemampuanBicara::class, 'id', 'kemampuan_bicara');
    }
    public $dates = ['tgl_expired'];
    protected $casts = [
        'tgl_expired' => 'datetime:Y-m-d'
    ];
}
