<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatUjiKompetensi;
use Exception;

class UsulanRiwayatUjiKompetensi extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatUjiKompetensi::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatUjiKompetensi();

            $r->tipe_jabatan_id = (int)@$data['new_data']['tipe_jabatan_id'];
            $r->jabatan_id = (int)@$data['new_data']['jabatan_id'];
            $r->jabatan_text = @$data['new_data']['jabatan_text'];
            $r->satuan_kerja_id =(int) @$data['new_data']['satuan_kerja_id'];
            $r->satuan_kerja_text = @$data['new_data']['satuan_kerja_text'];
            $r->kategori_pemetaan_id = @$data['new_data']['kategori_pemetaan_id'];
            $r->metode = @$data['new_data']['metode'];
            $r->kotak_talenta = @$data['new_data']['kotak_talenta'];
            $r->tanggal = @$data['new_data']['tanggal'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatUjiKompetensi::where("id", @$data["id"])->get()->first();

            $r->tipe_jabatan_id = (int)@$data['new_data']['tipe_jabatan_id'];
            $r->jabatan_id = (int)@$data['new_data']['jabatan_id'];
            $r->jabatan_text = @$data['new_data']['jabatan_text'];
            $r->satuan_kerja_id = (int)@$data['new_data']['satuan_kerja_id'];
            $r->satuan_kerja_text = @$data['new_data']['satuan_kerja_text'];
            $r->kategori_pemetaan_id = @$data['new_data']['kategori_pemetaan_id'];
            $r->metode = @$data['new_data']['metode'];
            $r->kotak_talenta = @$data['new_data']['kotak_talenta'];
            $r->tanggal = @$data['new_data']['tanggal'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
