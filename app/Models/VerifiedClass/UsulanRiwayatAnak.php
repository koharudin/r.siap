<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAnak;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatAnak extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatAnak::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatAnak();
            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->jenis_kelamin = @$data['new_data']['sex'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->status_keluarga = @$data['new_data']['status_keluarga'];
            $r->status_tunjangan = @$data['new_data']['status_tunjangan'];
            $r->bln_dibayar = @$data['new_data']['bln_dibayar'];
            $r->bln_akhir_dibayar = @$data['new_data']['bln_akhir_dibayar'];
            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatAnak::where("id", @$data["id"])->get()->first();
            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->jenis_kelamin = @$data['new_data']['sex'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->status_keluarga = @$data['new_data']['status_keluarga'];
            $r->status_tunjangan = @$data['new_data']['status_tunjangan'];
            $r->bln_dibayar = @$data['new_data']['bln_dibayar'];
            $r->bln_akhir_dibayar = @$data['new_data']['bln_akhir_dibayar'];
            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
