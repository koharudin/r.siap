<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use DefaultDatetimeFormat;
    public $table  = 'riwayat_jabatan';

    public function obj_jabatan_fungsional(){
        return $this->hasOne(Jabatan::class,'id','jabatan_id');
    }
    public function obj_jabatan_struktural(){
        return $this->hasOne(UnitKerja::class,'id','jabatan_id');
    }
    public function obj_tipe_jabatan(){
        return $this->hasOne(TipeJabatan::class,'id','tipe_jabatan_id');
    }
    protected $dates = ['tmt_jabatan','tgl_sk'];
}
