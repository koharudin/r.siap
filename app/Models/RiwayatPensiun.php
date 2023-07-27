<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class RiwayatPensiun extends Model
{
    public $table  = 'riwayat_pensiun';
    public $dates = ['tgl_pensiun', 'tmt_pensiun'];

    public function obj_employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
    public function scopeAkanPensiun($query)
    {
        $now = Carbon::now();
        $now->setTime(0, 0, 0);
        $dt_akan_pensiun = $now->addYear(1)->addMonth(6);
        $query->whereNotNull('tgl_pensiun');
        $query->where('tgl_pensiun', '<=', $dt_akan_pensiun);
        $query->where('tgl_pensiun','>=',Carbon::now());
    }
}
