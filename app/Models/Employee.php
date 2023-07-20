<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    public $table  = 'employee';
    public $primaryKey = 'id';
    public $timestamps  = true;

    
    public function obj_satker()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'unit_id');
    }
    public function obj_agama()
    {
        return $this->hasOne(Agama::class, 'id', 'agama_id');
    }
    public function obj_riwayat_pangkat()
    {
        return $this->hasMany(RiwayatPangkat::class, 'employee_id', 'id')->orderBy('tmt_pangkat', 'asc');
    }
    public function obj_riwayat_pendidikan()
    {
        return $this->hasMany(RiwayatPendidikan::class, 'employee_id', 'id')->orderBy('tahun', 'asc');
    }
    public function obj_riwayat_jabatan()
    {
        return $this->hasMany(RiwayatJabatan::class, 'employee_id', 'id')->orderBy('tmt_jabatan', 'asc');
    }
    public function obj_riwayat_diklat_struktural()
    {
        return $this->hasMany(RiwayatDiklatStruktural::class, 'employee_id', 'id')->orderBy('tahun', 'asc')->orderBy('tgl_mulai', 'asc');
    }
    public function obj_riwayat_diklat_teknis()
    {
        return $this->hasMany(RiwayatDiklatTeknis::class, 'employee_id', 'id')->orderBy('tahun', 'asc')->orderBy('tgl_mulai', 'asc');
    }
}
