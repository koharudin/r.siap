<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatPotensiDiri extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatPotensiDiri::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatPotensiDiri();

            $r->tahun = @$data['new_data']['tahun'];
            $r->tanggung_jawab = @$data['new_data']['tanggung_jawab'];
            $r->motivasi = @$data['new_data']['motivasi'];
            $r->minat = @$data['new_data']['minat'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatPotensiDiri::where("id", @$data["id"])->get()->first();

            $r->tahun = @$data['new_data']['tahun'];
            $r->tanggung_jawab = @$data['new_data']['tanggung_jawab'];
            $r->motivasi = @$data['new_data']['motivasi'];
            $r->minat = @$data['new_data']['minat'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
