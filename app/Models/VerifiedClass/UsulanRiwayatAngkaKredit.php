<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use Exception;

class UsulanRiwayatAngkaKredit extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatAngkaKredit::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatAngkaKredit();
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->dt_awal_penilaian = @$data['new_data']['dt_awal_penilaian'];
            $r->dt_akhir_penilaian = @$data['new_data']['dt_akhir_penilaian'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->unit_kerja_id = @$data['new_data']['unit_kerja_id'];
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            $r->ak_lama = @$data['new_data']['ak_lama'];
            $r->ak_baru = @$data['new_data']['ak_baru'];
            $r->keterangan = @$data['new_data']['keterangan'];
            $r->tmt_pak = @$data['new_data']['tmt_pak'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatAngkaKredit::where("id", @$data["id"])->get()->first();
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->dt_awal_penilaian = @$data['new_data']['dt_awal_penilaian'];
            $r->dt_akhir_penilaian = @$data['new_data']['dt_akhir_penilaian'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->unit_kerja_id = @$data['new_data']['unit_kerja_id'];
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            $r->ak_lama = @$data['new_data']['ak_lama'];
            $r->ak_baru = @$data['new_data']['ak_baru'];
            $r->keterangan = @$data['new_data']['keterangan'];
            $r->tmt_pak = @$data['new_data']['tmt_pak'];
            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
