<?php

namespace App\Models;

use Encore\Admin\Auth\Database\Administrator;
use Illuminate\Database\Eloquent\Model;

class RiwayatUsulanLog extends Model
{
    public $table  = 'request_log';


    public function obj_riwayat_usulan(){
        return $this->hasOne(RiwayatUsulan::class,'id','request_id');
    } 
    public function obj_user(){
        return $this->hasOne(Administrator::class,'id','user_id');
    } 
}
