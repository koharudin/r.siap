<?php

namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;

class RiwayatSesiKerja extends Model
{
     public $connection = 'db_presensi';
     public $table  = 'tbl_sesikerja';
     public $primaryKey = 'sesikerja_id';
}
