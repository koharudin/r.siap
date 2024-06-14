<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatOrangTua extends Model
{

    public $table  = 'riwayat_orangtua';
    public $primaryKey = "id";
    public $dates = ['birth_date'];
    protected $casts = [
        'birth_date' => 'datetime:Y-m-d'
    ];
}
