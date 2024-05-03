<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatMutasi extends Model
{
    public $table  = 'riwayat_mutasi';
    protected $dates = ['tgl_sk','tmt_sk'];

    public function getTTglSKAttribute(){
        return $this->tgl_sk->format('d-m-Y');
    }
}
