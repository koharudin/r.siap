<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatNikah;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatNikah extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatNikah::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatNikah();

            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->buku_nikah = @$data['new_data']['buku_nikah'];
            $r->no_karis = @$data['new_data']['no_karis'];
            $r->tgl_kawin = @$data['new_data']['tgl_kawin'];
            $r->jenis_pekerjaan = @$data['new_data']['jenis_pekerjaan'];
            $r->nip = @$data['new_data']['nip'];
            $r->urutan_nikah = @$data['new_data']['urutan_nikah'];
            $r->urutan_pasangan = @$data['new_data']['urutan_pasangan'];
            $r->tempat_pekerjaan = @$data['new_data']['tempat_pekerjaan'];
            $r->status = @$data['new_data']['status'];
            $r->no_sk_cerai = @$data['new_data']['no_sk_cerai'];
            $r->tmt_sk_cerai = @$data['new_data']['tmt_sk_cerai'];
            $r->tgl_sk_cerai = @$data['new_data']['tgl_sk_cerai'];
            $r->sdh_dibayar = @$data['new_data']['sdh_dibayar'];
            $r->status_tunjangan = @$data['new_data']['status_tunjangan'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->bulan_dibayar = @$data['new_data']['bulan_dibayar'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatNikah::where("id", @$data["id"])->get()->first();

            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->buku_nikah = @$data['new_data']['buku_nikah'];
            $r->no_karis = @$data['new_data']['no_karis'];
            $r->tgl_kawin = @$data['new_data']['tgl_kawin'];
            $r->jenis_pekerjaan = @$data['new_data']['jenis_pekerjaan'];
            $r->nip = @$data['new_data']['nip'];
            $r->urutan_nikah = @$data['new_data']['urutan_nikah'];
            $r->urutan_pasangan = @$data['new_data']['urutan_pasangan'];
            $r->tempat_pekerjaan = @$data['new_data']['tempat_pekerjaan'];
            $r->status = @$data['new_data']['status'];
            $r->no_sk_cerai = @$data['new_data']['no_sk_cerai'];
            $r->tmt_sk_cerai = @$data['new_data']['tmt_sk_cerai'];
            $r->tgl_sk_cerai = @$data['new_data']['tgl_sk_cerai'];
            $r->sdh_dibayar = @$data['new_data']['sdh_dibayar'];
            $r->status_tunjangan = @$data['new_data']['status_tunjangan'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->bulan_dibayar = @$data['new_data']['bulan_dibayar'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
