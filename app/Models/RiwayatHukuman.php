<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatHukuman extends Model
{
    public $table  = 'riwayat_hukuman';

    public function nama_hukuman(){
        return $this->hasOne(Hukuman::class,'simpeg_id','hukuman_id');
    }
}
