<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSaudara extends Model
{
    public $table  = 'riwayat_saudara';

    public function obj_jenis_kelamin()
    {
        return $this->hasOne(JenisKelamin::class, 'id', 'jenis_kelamin');
    }
    public $dates = ['birth_date'];
    protected $casts = [
        'birth_date' => 'datetime:Y-m-d'
    ];
}
