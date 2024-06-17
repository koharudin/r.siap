<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatOrangTua;
use Exception;

class UsulanRiwayatOrangTua extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatOrangTua::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatOrangTua();

            $r->name = @$data['new_data']['name'];
            $r->status = @$data['new_data']['status'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->alamat = @$data['new_data']['alamat'];
            $r->telepon = @$data['new_data']['telepon'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatOrangTua::where("id", @$data["id"])->get()->first();

            $r->name = @$data['new_data']['name'];
            $r->status = @$data['new_data']['status'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->pekerjaan = @$data['new_data']['pekerjaan'];
            $r->alamat = @$data['new_data']['alamat'];
            $r->telepon = @$data['new_data']['telepon'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
