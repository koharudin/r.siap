<?php

namespace App\Models\Presensi;

use Illuminate\Database\Eloquent\Model;

class HariLibur extends Model
{
     public $primaryKey = 'id_holiday';

     public $connection = 'db_presensi';
     public $table  = 'tbl_holiday';
}
