<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPenghargaan;
use Exception;

class UsulanRiwayatPenghargaan extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatPenghargaan::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatPenghargaan();

            $r->nama_penghargaan = @$data['new_data']['nama_penghargaan'];
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->tahun = @$data['new_data']['tahun'];
            $r->jenis_penghargaan = @$data['new_data']['jenis_penghargaan'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->jenis_penghargaan_id = @$data['new_data']['jenis_penghargaan_id'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatPenghargaan::where("id", @$data["id"])->get()->first();

            $r->nama_penghargaan = @$data['new_data']['nama_penghargaan'];
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->tahun = @$data['new_data']['tahun'];
            $r->jenis_penghargaan = @$data['new_data']['jenis_penghargaan'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->jenis_penghargaan_id = @$data['new_data']['jenis_penghargaan_id'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
