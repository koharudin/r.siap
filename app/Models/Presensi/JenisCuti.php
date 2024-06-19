<?php

namespace App\Models\Presensi;

use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
     public $primaryKey = 'id_jenis_cuti';
     public $connection = 'db_presensi';
     public $table  = 'tbl_jenis_cuti';
     
}
