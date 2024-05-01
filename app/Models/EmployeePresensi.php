<?php

namespace App\Models;

use App\Models\Presensi\RiwayatIzin;
use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Exception;

class EmployeePresensi extends Model
{
    use HasFactory;
    public $connection = 'db_presensi';
    public $table = 'tpegawai';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function obj_riwayat_izin()
    {
        return $this->hasMany(RiwayatIzin::class, 'no_pekerja', 'nomor_pekerja')->orderBy('tgl_mulai', 'desc');
    }
}
