<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatSumpah;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatSumpah extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatSumpah::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatSumpah();

            $r->no_sumpah = @$data['new_data']['no_sumpah'];
            $r->tgl_sumpah = @$data['new_data']['tgl_sumpah'];
            $r->keterangan = @$data['new_data']['keterangan'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatSumpah::where("id", @$data["id"])->get()->first();
            
            $r->no_sumpah = @$data['new_data']['no_sumpah'];
            $r->tgl_sumpah = @$data['new_data']['tgl_sumpah'];
            $r->keterangan = @$data['new_data']['keterangan'];


            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
