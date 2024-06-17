<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatKinerja;
use Exception;

class UsulanRiwayatKinerja extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatKinerja::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatKinerja();

            $r->tahun = (int)@$data['new_data']['tahun'];
            $r->nilai = @$data['new_data']['nilai'];
            $r->tgl_penilaian = @$data['new_data']['tgl_penilaian'];
            $r->satuan_kerja = @$data['new_data']['satuan_kerja'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->nilai_skp = @$data['new_data']['nilai_skp'];
            $r->nilai_perilaku = @$data['new_data']['nilai_perilaku'];
            $r->satuan_kerja_id = @$data['new_data']['satuan_kerja_id'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatKinerja::where("id", @$data["id"])->get()->first();

            $r->tahun = (int)@$data['new_data']['tahun'];
            $r->nilai = @$data['new_data']['nilai'];
            $r->tgl_penilaian = @$data['new_data']['tgl_penilaian'];
            $r->satuan_kerja = @$data['new_data']['satuan_kerja'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->nilai_skp = @$data['new_data']['nilai_skp'];
            $r->nilai_perilaku = @$data['new_data']['nilai_perilaku'];
            $r->satuan_kerja_id = @$data['new_data']['satuan_kerja_id'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
