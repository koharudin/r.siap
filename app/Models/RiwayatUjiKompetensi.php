<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatUjiKompetensi extends Model
{
    public $table  = 'riwayat_uji_kompetensi';

    public function getTTahunAttribute()
    {
        return $this->tanggal->format('Y');
    }
    public $dates = ['tanggal'];
    protected $appends = [
        'jabatan_id_fungsional',
        'jabatan_id_struktural'
    ];
    public function getJabatanIdFungsionalAttribute()
    {
        if ($this->tipe_jabatan_id == 1) return $this->jabatan_id;
    }
    public function getJabatanIdStrukturalAttribute()
    {
        if ($this->tipe_jabatan_id == 2) return $this->jabatan_id;
    }
    protected $casts = [
        'tanggal' => 'datetime:Y-m-d'
    ];
}
