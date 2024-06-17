<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPenguasaanBahasa;
use Exception;

class UsulanRiwayatPenguasaanBahasa extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatPenguasaanBahasa::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatPenguasaanBahasa();

            $r->jenis_bahasa = @$data['new_data']['jenis_bahasa'];
            $r->nama_bahasa = @$data['new_data']['nama_bahasa'];
            $r->kemampuan_bicara = @$data['new_data']['kemampuan_bicara'];
            $r->jenis_sertifikasi = @$data['new_data']['jenis_sertifikasi'];
            $r->lembaga_sertifikasi = @$data['new_data']['lembaga_sertifikasi'];
            $r->skor = @$data['new_data']['skor'];
            $r->tgl_expired = @$data['new_data']['tgl_expired'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatPenguasaanBahasa::where("id", @$data["id"])->get()->first();

            $r->jenis_bahasa = @$data['new_data']['jenis_bahasa'];
            $r->nama_bahasa = @$data['new_data']['nama_bahasa'];
            $r->kemampuan_bicara = @$data['new_data']['kemampuan_bicara'];
            $r->jenis_sertifikasi = @$data['new_data']['jenis_sertifikasi'];
            $r->lembaga_sertifikasi = @$data['new_data']['lembaga_sertifikasi'];
            $r->skor = @$data['new_data']['skor'];
            $r->tgl_expired = @$data['new_data']['tgl_expired'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
