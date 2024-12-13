<?php

namespace App\Models\Presensi;

use Illuminate\Database\Eloquent\Model;

class DetailJenisCuti extends Model
{
     public $primaryKey = 'id_detail_jenis_cuti';
     public $connection = 'db_presensi';
     public $table  = 'tbl_detail_jenis_cuti';
}
