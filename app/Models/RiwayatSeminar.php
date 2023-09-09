<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSeminar extends Model
{
    public $table = 'riwayat_seminar';
    
    public $dates = ['tgl_mulai', 'tgl_selesai'];

    public function obj_id()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
