<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatDiklatFungsional extends Model
{
    public $table  = 'riwayat_diklat_teknis';

    public function scopeDiklatFungsional($query){
        $query->where('jenis_diklat',2);
    }
    
    public $dates = ['tgl_mulai', 'tgl_selesai','tgl_sttpp'];
    protected $casts = [
        'tgl_mulai'=> 'datetime:Y-m-d', 'tgl_selesai'=> 'datetime:Y-m-d','tgl_sttpp'=> 'datetime:Y-m-d'
    ];


    public function obj_id()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
