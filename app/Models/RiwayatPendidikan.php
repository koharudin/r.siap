<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    public $table  = 'riwayat_pendidikan';

    public function obj_pendidikan(){
        return $this->hasOne(Pendidikan::class,'id','pendidikan_id');
    }
    public function getTPendidikanAttribute(){
        return $this->obj_pendidikan->name;
    }
}
