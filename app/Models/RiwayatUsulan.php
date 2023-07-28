<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatUsulan extends Model
{
    public $table  = 'riwayat_usulan';


    public function obj_employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    } 
    public function obj_status(){
        return $this->hasOne(StatusUsulan::class,'id','status_id');
    } 
    public function obj_kategori_layanan(){
        return $this->hasOne(KategoriLayanan::class,'id','kategori_layanan_id');
    } 
    
}
