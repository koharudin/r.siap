<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSKPNS extends Model
{
    public $table  = 'riwayat_skpns';
    protected $dates = ['tmt_pns','tgl_sk'];
}
