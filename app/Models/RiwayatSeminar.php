<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSeminar extends Model
{
    public $table  = 'riwayat_seminar';

    public function getTTahunAttribute()
    {
        if ($this->tgl_piagam) return $this->tgl_piagam->format('Y');
        else return "";
    }
    public $dates = ['tgl_mulai', 'tgl_selesai', 'tgl_piagam'];
    protected $casts = [
        'tgl_mulai' => 'datetime:Y-m-d', 'tgl_selesai' => 'datetime:Y-m-d', 'tgl_piagam' => 'datetime:Y-m-d'
    ];

    public function obj_id()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
