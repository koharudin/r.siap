<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatSKPNS extends Model
{
    public $table  = 'riwayat_skpns';
    protected $dates = ['tmt_pns','tgl_sk'];
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            // ... code here
        });

        self::created(function ($model) {
            // ... code here
            //update riwayat pangkat
            $riwayat_skpns = RiwayatPangkat::where('employee_id',$model->employee_id)->where('is_cpns_pns',RiwayatPangkat::SK_PNS)->get()->first();
            if(!$riwayat_skpns){
                $riwayat_skpns = new RiwayatPangkat();
                $riwayat_skpns->employee_id = $model->employee_id;
                $riwayat_skpns->is_cpns_pns = RiwayatPangkat::SK_PNS;
                $riwayat_skpns->jenis_ket = "SKPNS";
            }
    
            $riwayat_skpns->no_sk = $model->no_sk;
            $riwayat_skpns->tgl_sk = $model->tgl_sk;
            $riwayat_skpns->tmt_pangkat = $model->tmt_pns;
            $riwayat_skpns->pangkat_id = $model->pangkat_id;
            $riwayat_skpns->jenis_kp = JenisKP::KP_REGULER;
            
            $riwayat_skcpns = RiwayatPangkat::where('employee_id',$model->employee_id)->where('is_cpns_pns',RiwayatPangkat::SK_CPNS)->get()->first();
            
            $ms_bulan = $riwayat_skcpns->masa_kerja_thn *12 + $riwayat_skcpns->masa_kerja_bln;

            $m = $riwayat_skcpns->tmt_pangkat->diffInMonths($model->tmt_pns);
            $total_m = $m + $ms_bulan;
            $riwayat_skpns->masakerja_thn = (int)($total_m/12);
            $riwayat_skpns->masakerja_bln =  $total_m%12;

            $riwayat_skpns->pejabat_penetap_id = $model->pejabat_penetap_id;
            $riwayat_skpns->pejabat_penetap_nip = $model->pejabat_penetap_nip;
            $riwayat_skpns->pejabat_penetap_jabatan = $model->pejabat_penetap_jabatan;
            $riwayat_skpns->pejabat_penetap_nama = $model->pejabat_penetap_nama;

            $riwayat_skpns->save();
        });

        self::updating(function ($model) {
            // ... code here
        });

        self::updated(function ($model) {
            // ... code here
            //update riwayat pangkat
            $riwayat_skpns = RiwayatPangkat::where('employee_id',$model->employee_id)->where('is_cpns_pns',RiwayatPangkat::SK_PNS)->get()->first();
            if(!$riwayat_skpns){
                $riwayat_skpns = new RiwayatPangkat();
                $riwayat_skpns->employee_id = $model->employee_id;
                $riwayat_skpns->is_cpns_pns = RiwayatPangkat::SK_PNS;
                $riwayat_skpns->jenis_ket = "SKPNS";
            }
    
            $riwayat_skpns->no_sk = $model->no_sk;
            $riwayat_skpns->tgl_sk = $model->tgl_sk;
            $riwayat_skpns->tmt_pangkat = $model->tmt_pns;
            $riwayat_skpns->pangkat_id = $model->pangkat_id;
            $riwayat_skpns->jenis_kp = JenisKP::KP_REGULER;
            
            $riwayat_skcpns = RiwayatPangkat::where('employee_id',$model->employee_id)->where('is_cpns_pns',RiwayatPangkat::SK_CPNS)->get()->first();
            
            $ms_bulan = $riwayat_skcpns->masa_kerja_thn *12 + $riwayat_skcpns->masa_kerja_bln;

            $m = $riwayat_skcpns->tmt_pangkat->diffInMonths($model->tmt_pns);
            $total_m = $m + $ms_bulan;
            $riwayat_skpns->masakerja_thn = (int)($total_m/12);
            $riwayat_skpns->masakerja_bln =  $total_m%12;

            $riwayat_skpns->pejabat_penetap_id = $model->pejabat_penetap_id;
            $riwayat_skpns->pejabat_penetap_nip = $model->pejabat_penetap_nip;
            $riwayat_skpns->pejabat_penetap_jabatan = $model->pejabat_penetap_jabatan;
            $riwayat_skpns->pejabat_penetap_nama = $model->pejabat_penetap_nama;

            $riwayat_skpns->save();
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }
}
