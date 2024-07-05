<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatCuti extends Model
{
     public $connection = 'db_presensi';
     public $table  = 'tbl_cuti';
     public $primaryKey = 'id_cuti';

     public $timestamps = false;
}
