<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPendidikan extends Model
{
    public $table  = 'riwayat_pendidikan';

    public function updateLastRiwayatPendidikan()
    {
        $this->load('obj_pegawai');
        $this->obj_pegawai->updateLastRiwayatPendidikan();
    }
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            $model->updateLastRiwayatPendidikan();
        });

        self::updating(function ($model) {
            // ... code here
        });
        self::updated(function ($model) {
            $model->updateLastRiwayatPendidikan();
        });
        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            $model->updateLastRiwayatPendidikan();
            // ... code here
        });
    }


    public function obj_pendidikan()
    {
        return $this->hasOne(Pendidikan::class, 'id', 'pendidikan_id');
    }
    public function getTahunAttribute()
    {
        if (@$this->tahun) {
            return $this->tahun;
        } else return "";
    }
    public function getTPendidikanAttribute()
    {
        return $this->obj_pendidikan->name;
    }
}
