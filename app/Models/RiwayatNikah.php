<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatNikah extends Model
{
    public $table  = 'riwayat_nikah';

    protected static function booted(): void
    {
        self::created(function ($model) {
            $model->load("obj_employee.obj_riwayat_nikah");
            if ($model->obj_employee) {
                $last = $model->obj_employee->obj_riwayat_nikah->last();
                if ($last) {
                    if ($last->status == StatusMenikah::MENIKAH) {
                        $model->obj_employee->status_kawin = "K";
                    } else {
                        $model->obj_employee->status_kawin = null;
                    }
                    $model->obj_employee->save();
                }
            }
        });
        self::updated(function ($model) {
            $model->load("obj_employee.obj_riwayat_nikah");
            if ($model->obj_employee) {
                $last = $model->obj_employee->obj_riwayat_nikah->last();
                if ($last) {
                    if ($last->status == StatusMenikah::MENIKAH) {
                        $model->obj_employee->status_kawin = "K";
                    } else {
                        $model->obj_employee->status_kawin = null;
                    }
                    $model->obj_employee->save();
                }
            }
        });
        self::deleted(function ($model) {
            $model->load("obj_employee.obj_riwayat_nikah");
            if ($model->obj_employee) {
                $last = $model->obj_employee->obj_riwayat_nikah->last();
                if ($last) {
                    if ($last->status == StatusMenikah::MENIKAH) {
                        $model->obj_employee->status_kawin = "K";
                    } else {
                        $model->obj_employee->status_kawin = null;
                    }
                } else  $model->obj_employee->status_kawin = null;
                $model->obj_employee->save();
            }
        });
    }
    public function obj_employee()
    {
        return $this->belongsTo(Employee::class, "employee_id", 'id');
    }
    public function obj_status_menikah()
    {
        return $this->hasOne(StatusMenikah::class, 'id', 'status');
    }
    public function obj_jenis_pekerjaan()
    {
        return $this->hasOne(JenisPekerjaan::class, 'id', 'jenis_pekerjaan');
    }
    public $dates = ['birth_date', 'tgl_kawin', 'tgl_sk_cerai', 'tmt_sk_cerai'];

    protected $casts = [
        'birth_date' => 'datetime:Y-m-d',
        'tgl_kawin' => 'datetime:Y-m-d',
        'tgl_sk_cerai' => 'datetime:Y-m-d',
        'tmt_sk_cerai' => 'datetime:Y-m-d'
    ];
}
