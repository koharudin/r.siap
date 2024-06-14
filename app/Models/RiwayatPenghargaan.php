<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPenghargaan extends Model
{
    public $table  = 'riwayat_penghargaan';
    public $dates = ['tgl_sk'];

    public function obj_employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function obj_jenis_penghargaan()
    {
        return $this->hasOne(JenisPenghargaan::class, 'id', 'jenis_penghargaan_id');
    }
    protected $casts = [
        'tgl_sk' => 'datetime:Y-m-d'
    ];
}
