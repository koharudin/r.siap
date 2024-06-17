<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatSaudara;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatSaudara extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatSaudara::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatSaudara();

            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->jenis_kelamin = @$data['new_data']['sex'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->alamat = @$data['new_data']['alamat'];
            $r->telepon = @$data['new_data']['telepon'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatSaudara::where("id", @$data["id"])->get()->first();

            $r->name = @$data['new_data']['name'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->jenis_kelamin = @$data['new_data']['sex'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->alamat = @$data['new_data']['alamat'];
            $r->telepon = @$data['new_data']['telepon'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
