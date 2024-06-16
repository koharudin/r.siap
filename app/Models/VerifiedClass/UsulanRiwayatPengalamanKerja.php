<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPengalamanKerja;
use Exception;

class UsulanRiwayatPengalamanKerja extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatPengalamanKerja::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatPengalamanKerja();

            $r->instansi = @$data['new_data']['instansi'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->masa_kerja_tahun = (int) @$data['new_data']['masa_kerja_tahun'];
            $r->masa_kerja_bulan = (int)@$data['new_data']['masa_kerja_bulan'];
            $r->tgl_kerja = @$data['new_data']['tgl_kerja'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatPengalamanKerja::where("id", @$data["id"])->get()->first();

            $r->instansi = @$data['new_data']['instansi'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->masa_kerja_tahun = (int)@$data['new_data']['masa_kerja_tahun'];
            $r->masa_kerja_bulan = (int) @$data['new_data']['masa_kerja_bulan'];
            $r->tgl_kerja = @$data['new_data']['tgl_kerja'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
