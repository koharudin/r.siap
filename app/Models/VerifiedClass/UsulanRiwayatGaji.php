<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatGaji;
use Exception;

class UsulanRiwayatGaji extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatGaji::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatGaji();

            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->masakerja_tahun = @$data['new_data']['masakerja_tahun'];
            $r->masakerja_bulan = @$data['new_data']['masakerja_bulan'];
            $r->jenis_kenaikan = @$data['new_data']['jenis_kenaikan'];
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            $r->gaji_pokok = @$data['new_data']['gaji_pokok'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatGaji::where("id", @$data["id"])->get()->first();

            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_sk = @$data['new_data']['tmt_sk'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->masakerja_tahun = @$data['new_data']['masakerja_tahun'];
            $r->masakerja_bulan = @$data['new_data']['masakerja_bulan'];
            $r->jenis_kenaikan = @$data['new_data']['jenis_kenaikan'];
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            $r->gaji_pokok = @$data['new_data']['gaji_pokok'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
