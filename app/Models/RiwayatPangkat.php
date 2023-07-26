<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatPangkat extends Model
{
    public $table  = 'riwayat_pangkat';
    const SK_CPNS = 1;
    const SK_PNS = 2;
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
            // insert into riwayat gaji
            $record = RiwayatGaji::where('riwayat_pangkat_id', $model->id)->get()->first();
            if (!$record) {
                $record = new RiwayatGaji();
                $record->riwayat_pangkat_id = $model->id;
                $record->employee_id = $model->employee_id;
            }
            $record->no_sk = $model->no_sk;
            $record->tgl_sk = $model->tgl_sk;
            $record->tmt_sk = $model->tmt_sk;
            $record->pejabat_penetap_jabatan = $model->pejabat_penetap_jabatan;
            $record->masakerja_tahun = $model->masakerja_thn;
            $record->masakerja_bulan = $model->masakerja_bln;
            $record->gaji_pokok = 0;
            $record->jenis_kenaikan = $model->jenis_kp;
            $record->pangkat_id  = $model->pangkat_id;
            if($model->is_cpns_pns ==1){

            }
            $record->save();
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here

            $record = RiwayatGaji::where('riwayat_pangkat_id', $model->id)->get()->first();
            if (!$record) {
                $record = new RiwayatGaji();
                $record->riwayat_pangkat_id = $model->id;
                $record->employee_id = $model->employee_id;
            }
            $record->no_sk = $model->no_sk;
            $record->tgl_sk = $model->tgl_sk;
            $record->tmt_sk = $model->tmt_sk;
            $record->pejabat_penetap_jabatan = $model->pejabat_penetap_jabatan;
            $record->masakerja_tahun = $model->masakerja_thn;
            $record->masakerja_bulan = $model->masakerja_bln;
            $record->gaji_pokok = 0;
            $record->jenis_kenaikan = $model->jenis_kp;
            $record->pangkat_id  = $model->pangkat_id;
            if($model->is_cpns_pns ==RiwayatPangkat::SK_CPNS){
                $gapok = GajiPokok::where('pangkat_id',$model->pangkat_id)->where('masa_kerja',0)->orderBy('tahun','asc')->get()->last();
                $record->gaji_pokok = $gapok?($gapok->gaji_pokok*80/100):null;
            }
            else {
                $gapok = GajiPokok::where('pangkat_id',$model->pangkat_id)->where('masa_kerja',$model->masakerja_thn)->orderBy('tahun','asc')->get()->last();
                $record->gaji_pokok = $gapok?$gapok->gaji_pokok:null;
            }
            $record->save();
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }

    public function obj_pangkat()
    {
        return $this->hasOne(Pangkat::class, 'id', 'pangkat_id');
    }
    public function obj_jenis_kenaikan_pangkat()
    {
        return $this->hasOne(JenisKP::class, 'id', 'jenis_kp');
    }

    protected $dates = ['tmt_pangkat', 'tgl_sk'];
}
