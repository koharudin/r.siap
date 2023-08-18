<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSKCPNS extends Model
{
    public $table  = 'riwayat_skcpns';
    protected $dates = ['tmt_cpns', 'tgl_sk'];

    public function obj_employee(){
        return $this->hasOne(Employee::class,'id','employee_id');
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
            //update riwayat pangkat
            $riwayat_pangkat_skcpns = RiwayatPangkat::where('employee_id', $model->employee_id)->where('is_cpns_pns', RiwayatPangkat::SK_CPNS)->get()->first();
            if (!$riwayat_pangkat_skcpns) {
                $riwayat_pangkat_skcpns = new RiwayatPangkat();
                $riwayat_pangkat_skcpns->employee_id = $model->employee_id;
                $riwayat_pangkat_skcpns->is_cpns_pns = RiwayatPangkat::SK_CPNS;
                $riwayat_pangkat_skcpns->jenis_ket = "CPNS";
            }
            $riwayat_pangkat_skcpns->pejabat_penetap_id = $model->pejabat_penetap_id;
            $riwayat_pangkat_skcpns->no_nota = $model->no_nota;
            $riwayat_pangkat_skcpns->no_sk = $model->no_sk;
            $riwayat_pangkat_skcpns->tgl_sk = $model->tgl_sk;
            $riwayat_pangkat_skcpns->tmt_pangkat = $model->tmt_cpns;
            $riwayat_pangkat_skcpns->pangkat_id = $model->pangkat_id;
            $riwayat_pangkat_skcpns->masakerja_thn = $model->total_tahun;
            $riwayat_pangkat_skcpns->masakerja_bln = $model->total_bulan;
            $riwayat_pangkat_skcpns->save();
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here
            //update riwayat pangkat
            $riwayat_pangkat_skcpns = RiwayatPangkat::where('employee_id', $model->employee_id)->where('is_cpns_pns', RiwayatPangkat::SK_CPNS)->get()->first();
            if (!$riwayat_pangkat_skcpns) {
                $riwayat_pangkat_skcpns = new RiwayatPangkat();
                $riwayat_pangkat_skcpns->employee_id = $model->employee_id;
                $riwayat_pangkat_skcpns->is_cpns_pns = RiwayatPangkat::SK_CPNS;
                $riwayat_pangkat_skcpns->jenis_ket = "CPNS";
            }
            $riwayat_pangkat_skcpns->pejabat_penetap_id = $model->pejabat_penetap_id;
            $riwayat_pangkat_skcpns->no_nota = $model->no_nota;
            $riwayat_pangkat_skcpns->no_sk = $model->no_sk;
            $riwayat_pangkat_skcpns->tgl_sk = $model->tgl_sk;
            $riwayat_pangkat_skcpns->tmt_pangkat = $model->tmt_cpns;
            $riwayat_pangkat_skcpns->pangkat_id = $model->pangkat_id;
            $riwayat_pangkat_skcpns->masakerja_thn = $model->total_tahun;
            $riwayat_pangkat_skcpns->masakerja_bln = $model->total_bulan;
            $riwayat_pangkat_skcpns->save();
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }
}
