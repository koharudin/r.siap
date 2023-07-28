<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatHukuman extends Model
{
    public $table  = 'riwayat_hukuman';

    public function obj_employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }
    public function obj_hukuman(){
        return $this->hasOne(Hukuman::class,'id','hukuman_id');
    }

    public $dates = ['tgl_sk','tmt_sk','tgl_sk_akhir'];
}
