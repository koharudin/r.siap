<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatSKCPNS;
use Exception;

class UsulanSKCPNS extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 2) { //edit
            $r = RiwayatSKCPNS::where("employee_id", $request->employee_id)->get()->first();
            if (!$r) {
                $r = new RiwayatSKCPNS();
                $r->employee_id =  $request->employee_id;
            }
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            //$r->pangkat_text = @$data['new_data']['pangkat_text'];
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_cpns = @$data['new_data']['tmt_cpns'];
            $r->pejabat_penetap_id = (int)@$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->tgl_tugas = @$data['new_data']['tgl_tugas'];
            $r->no_sk_penyesuaian_mk = @$data['new_data']['no_sk_penyesuaian_mk'];
            $r->tgl_sk_penyesuaian_mk = @$data['new_data']['tgl_sk_penyesuaian_mk'];
            $r->tmt_sk_penyesuaian_mk = @$data['new_data']['tmt_sk_penyesuaian_mk'];
            $r->pejabat_penetap_id_sk_penyesuaian_mk = (int)@$data['new_data']['pejabat_penetap_id_sk_penyesuaian_mk'];
            //$r->pejabat_penetap_nip_sk_penyesuaian_mk = @$data['new_data']['pejabat_penetap_nip_sk_penyesuaian_mk'];
            //$r->pejabat_penetap_nama_sk_penyesuaian_mk = @$data['new_data']['pejabat_penetap_nama_sk_penyesuaian_mk'];
            $r->pejabat_penetap_jabatan_sk_penyesuaian_mk = @$data['new_data']['pejabat_penetap_jabatan_sk_penyesuaian_mk'];
            $r->tambahan_bulan = (int)@$data['new_data']['tambahan_bulan'];
            $r->tambahan_tahun = (int)@$data['new_data']['tambahan_tahun'];
            $r->total_tahun = (int)@$data['new_data']['total_tahun'];
            $r->total_bulan = (int)@$data['new_data']['total_bulan'];

            $r->save();
        }
    }
}
