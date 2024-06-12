<?php

namespace App\Models;

use App\Models\Presensi\RiwayatCuti;
use App\Models\Presensi\RiwayatIzin;
use App\Models\Presensi\RiwayatIzinLain;
use App\Models\Presensi\RiwayatSesiKerja;
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

    public function obj_riwayat_sesikerja()
    {
        return $this->hasMany(RiwayatSesiKerja::class, 'no_pekerja', 'nomor_pekerja')->orderBy('mulai', 'desc');
    }

    public function obj_riwayat_cuti()
    {
        return $this->hasMany(RiwayatCuti::class, 'no_pekerja', 'nomor_pekerja')->orderBy('tgl_mulai', 'desc');
    }
    public function obj_riwayat_izin()
    {
        return $this->hasMany(RiwayatIzin::class, 'no_pekerja', 'nomor_pekerja')->orderBy('tgl_mulai', 'desc');
    }
    public function obj_riwayat_izin_lain()
    {
        return $this->hasMany(RiwayatIzinLain::class, 'no_pekerja', 'nomor_pekerja')->orderBy('tgl_mulai', 'desc');
    }
}
