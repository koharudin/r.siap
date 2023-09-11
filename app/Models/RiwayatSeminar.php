<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSeminar extends Model
{
    public $table  = 'riwayat_seminar';

    public function getTTahunAttribute(){
        return $this->tgl_piagam->format('Y');
    }
    public $dates = ['tgl_mulai', 'tgl_selesai','tgl_piagam'];
    
    public function obj_id()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
