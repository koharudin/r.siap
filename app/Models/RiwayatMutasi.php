<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatMutasi extends Model
{
    public $table  = 'riwayat_mutasi';
    protected $dates = ['tgl_sk', 'tmt_sk'];
    public $appends = ['lama_kerja_diunit'];

    public function getTTglSKAttribute()
    {
        return $this->tgl_sk->format('d-m-Y');
    }
    public function getLamaKerjaDiunitAttribute()
    {
        return 13;
    }
    protected $casts = [
        'tgl_sk' => 'datetime:Y-m-d',
        'tmt_sk' => 'datetime:Y-m-d'
    ];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {

            $last_mutasi = $model->obj_pegawai->obj_riwayat_mutasi->last();
            $employee =   $model->obj_pegawai;
            $employee->unit_id = $last_mutasi->satker_id_baru;
            $employee->save();
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            $last_mutasi = $model->obj_pegawai->obj_riwayat_mutasi->last();
            $employee = $model->obj_pegawai;
            $employee->unit_id = $last_mutasi->satker_id_baru;
            $employee->save();
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            $last_mutasi = $model->obj_pegawai->obj_riwayat_mutasi->last();
            $employee = $model->obj_pegawai;
            $employee->unit_id = $last_mutasi->satker_id_baru;
            $employee->save();
        });
    }
    public function obj_pegawai()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
