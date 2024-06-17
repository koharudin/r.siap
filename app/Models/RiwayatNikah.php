<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatNikah extends Model
{
    public $table  = 'riwayat_nikah';

    public function obj_status_menikah()
    {
        return $this->hasOne(StatusMenikah::class, 'id', 'status');
    }
    public function obj_jenis_pekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::class, 'id', 'jenis_pekerjaan');
    }
    public $dates = ['birth_date', 'tgl_kawin', 'tgl_sk_cerai', 'tmt_sk_cerai'];

    protected $casts = [
        'birth_date' => 'datetime:Y-m-d',
        'tgl_kawin' => 'datetime:Y-m-d',
        'tgl_sk_cerai' => 'datetime:Y-m-d',
        'tmt_sk_cerai' => 'datetime:Y-m-d'
    ];
}
