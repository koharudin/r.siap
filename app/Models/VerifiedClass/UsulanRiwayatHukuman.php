<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatHukuman;
use Exception;

class UsulanRiwayatHukuman extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatHukuman::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatHukuman();

            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->pelanggaran = @$data['new_data']['pelanggaran'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->tmt_akhir = @$data['new_data']['tmt_akhir'];
            $r->masa_bulan = (int) @$data['new_data']['masa_bulan'];
            $r->masa_tahun = (int) @$data['new_data']['masa_tahun'];
            $r->nomor_pp = @$data['new_data']['nomor_pp'];
            $r->tingkat_hukuman = @$data['new_data']['tingkat_hukuman'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatHukuman::where("id", @$data["id"])->get()->first();

            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->pelanggaran = @$data['new_data']['pelanggaran'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->tmt_akhir = @$data['new_data']['tmt_akhir'];
            $r->masa_bulan =(int) @$data['new_data']['masa_bulan'];
            $r->masa_tahun = (int)@$data['new_data']['masa_tahun'];
            $r->nomor_pp = @$data['new_data']['nomor_pp'];
            $r->tingkat_hukuman = @$data['new_data']['tingkat_hukuman'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
