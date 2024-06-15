<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatMutasi;
use Exception;

class UsulanRiwayatMutasi extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatMutasi::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatMutasi();

            $$r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->satker_lama = @$data['new_data']['satker_lama'];
            $r->satker_baru = @$data['new_data']['satker_baru'];
            $r->satker_id_lama = @$data['new_data']['satker_id_lama'];
            $r->satker_id_baru = @$data['new_data']['satker_id_baru'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatMutasi::where("id", @$data["id"])->get()->first();

            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->satker_lama = @$data['new_data']['satker_lama'];
            $r->satker_baru = @$data['new_data']['satker_baru'];
            $r->satker_id_lama = @$data['new_data']['satker_id_lama'];
            $r->satker_id_baru = @$data['new_data']['satker_id_baru'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
