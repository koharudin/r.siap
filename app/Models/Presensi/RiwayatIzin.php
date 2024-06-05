<?php
namespace App\Models\Presensi;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
// Dinas LUAR
class RiwayatIzin extends Model
{
	 public $connection = "db_presensi";
     public $table  = 'tbl_izin';
     public $primaryKey = 'id_izin';

}
