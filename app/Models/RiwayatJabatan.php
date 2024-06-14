<?php

namespace App\Models;

use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Model;

class RiwayatJabatan extends Model
{
    use DefaultDatetimeFormat;
    public $table  = 'riwayat_jabatan';

    public function obj_pegawai()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function obj_employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function obj_unit_kerja()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'unit_id');
    }
    public function obj_jabatan_fungsional()
    {
        return $this->hasOne(Jabatan::class, 'id', 'jabatan_id');
    }
    public function obj_jabatan_struktural()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'jabatan_id');
    }
    public function obj_tipe_jabatan()
    {
        return $this->hasOne(TipeJabatan::class, 'id', 'tipe_jabatan_id');
    }
    public function updateLastRiwayatJabatan()
    {
        $this->load('obj_pegawai');
        $this->obj_pegawai->updateLastRiwayatJabatan();
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
            $model->updateLastRiwayatJabatan();
            // inserted ke pensiun2
            $model->obj_employee->setTanggalPensiun();
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here
            $model->updateLastRiwayatJabatan();
            // update ke pensiun2
            $model->obj_employee->setTanggalPensiun();
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
            $model->updateLastRiwayatJabatan();
        });
    }

    public function getTTipeJabatanAttribute()
    {
        return TipeJabatan::find($this->tipe_jabatan_id)->name;
    }
    public function getTTMTJabatanAttribute()
    {
        return $this->tmt_jabatan->format('d-m-Y');
    }
    protected $appends = [
        'jabatan_id_fungsional',
        'jabatan_id_struktural'
    ];

    public function getJabatanIdFungsionalAttribute()
    {
        if ($this->tipe_jabatan_id == 1 || $this->tipe_jabatan_id == 6) return null;
        else     return $this->jabatan_id;
    }
    public function getJabatanIdStrukturalAttribute()
    {
        if ($this->tipe_jabatan_id == 1 || $this->tipe_jabatan_id == 6) return $this->jabatan_id;
    }

    public $dates = ['tgl_sk','tmt_jabatan','tgl_pelantikan'];
    protected $casts = [
        'tgl_sk' => 'datetime:Y-m-d','tmt_jabatan' => 'datetime:Y-m-d','tgl_pelantikan' => 'datetime:Y-m-d'
    ];
}
