<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatKursus;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatKursus extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatKursus::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatKursus();
            $r->nama=@$data['new_data']['nama'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->angkatan=@$data['new_data']['angkatan'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            $r->no_sttpp=@$data['new_data']['no_sttpp'];
            $r->tgl_sttpp=@$data['new_data']['tgl_sttpp'];
            $r->lama_jam=@$data['new_data']['lama_jam'];
            $r->jenis_diklat_siasn=@$data['new_data']['jenis_diklat_siasn'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatKursus::where("id", @$data["id"])->get()->first();
            $r->nama=@$data['new_data']['nama'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->angkatan=@$data['new_data']['angkatan'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            $r->no_sttpp=@$data['new_data']['no_sttpp'];
            $r->tgl_sttpp=@$data['new_data']['tgl_sttpp'];
            $r->lama_jam=@$data['new_data']['lama_jam'];
            $r->jenis_diklat_siasn=@$data['new_data']['jenis_diklat_siasn'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
