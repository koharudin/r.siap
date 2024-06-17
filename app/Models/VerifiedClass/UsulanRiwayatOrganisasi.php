<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatOrganisasi;
use Exception;

class UsulanRiwayatOrganisasi extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatOrganisasi::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatOrganisasi();

            $r->nama = @$data['new_data']['nama'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->awal = @$data['new_data']['awal'];
            $r->akhir = @$data['new_data']['akhir'];
            $r->pimpinan = @$data['new_data']['pimpinan'];
            $r->tempat = @$data['new_data']['tempat'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatOrganisasi::where("id", @$data["id"])->get()->first();

            $r->nama = @$data['new_data']['nama'];
            $r->jabatan = @$data['new_data']['jabatan'];
            $r->awal = @$data['new_data']['awal'];
            $r->akhir = @$data['new_data']['akhir'];
            $r->pimpinan = @$data['new_data']['pimpinan'];
            $r->tempat = @$data['new_data']['tempat'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
