<?php

namespace App\Models;

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    public $table  = 'employee';
    public $primaryKey = 'id';
    public $timestamps  = true;


   
    public function scopeAktif($query){
        $query->whereIn('status_pegawai_id',[0,1,2]);
    }
    public function getBup()
    {
        $last = $this->obj_riwayat_jabatan->last();
        if ($last->tipe_jabatan_id == 1 || $last->tipe_jabatan_id == 6) {
            $obj = $last->obj_jabatan_struktural;
            return  $obj ? $obj->bup : null;
        } else if ($last->tipe_jabatan_id == 2) {
            return $last->obj_tipe_jabatan->bup;
        } else if ($last->tipe_jabatan_id >= 3 && $last->tipe_jabatan_id <= 5) {
            $obj = $last->obj_jabatan_fungsional;
            return $obj ? $obj->bup : null;
        }
    }
    public function setTanggalPensiun()
    {
        $bday = Carbon::createFromFormat("!Y-m-d", $this->birth_date);
        $bup = $this->getBup();
        if ($bup) {
            $pensiun  = $bday->addYear($bup);
            $this->tgl_pensiun = $pensiun->setDay($pensiun->daysInMonth);
        } else {
            $this->tgl_pensiun = null;
        }
        $this->save();
        return $this->tgl_pensiun;
    }
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
    public function getUsiaAttribute($from=null)
    {
        if($from==null){
            $from = Carbon::now();
        }
        return $this->birth_date->diffInMonths($from);
    }
    public $dates = ['birth_date','tgl_pensiun'];
}
