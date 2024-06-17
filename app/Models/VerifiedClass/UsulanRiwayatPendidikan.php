<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPendidikan;
use Exception;

class UsulanRiwayatPendidikan extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatPendidikan::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatPendidikan();

            $r->pendidikan_id = @$data['new_data']['pendidikan_id'];
            $r->jurusan = @$data['new_data']['jurusan'];
            $r->nama_sekolah = @$data['new_data']['nama_sekolah'];
            $r->tempat_sekolah = @$data['new_data']['tempat_sekolah'];
            $r->no_sttb = @$data['new_data']['no_sttb'];
            $r->tgl_sttb = @$data['new_data']['tgl_sttb'];
            $r->tahun = @$data['new_data']['tahun'];
            $r->kepala_sekolah = @$data['new_data']['kepala_sekolah'];
            $r->akreditasi = @$data['new_data']['akreditasi'];
            $r->ipk = @$data['new_data']['ipk'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatPendidikan::where("id", @$data["id"])->get()->first();

            $r->pendidikan_id = @$data['new_data']['pendidikan_id'];
            $r->jurusan = @$data['new_data']['jurusan'];
            $r->nama_sekolah = @$data['new_data']['nama_sekolah'];
            $r->tempat_sekolah = @$data['new_data']['tempat_sekolah'];
            $r->no_sttb = @$data['new_data']['no_sttb'];
            $r->tgl_sttb = @$data['new_data']['tgl_sttb'];
            $r->tahun = @$data['new_data']['tahun'];
            $r->kepala_sekolah = @$data['new_data']['kepala_sekolah'];
            $r->akreditasi = @$data['new_data']['akreditasi'];
            $r->ipk = @$data['new_data']['ipk'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
