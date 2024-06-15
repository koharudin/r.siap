<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatDp3;
use Exception;

class UsulanRiwayatDP3 extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatDp3::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatDp3();
            
            $r->kesetiaan=(double)@$data['new_data']['kesetiaan'];
            $r->prestasi=(double)@$data['new_data']['prestasi'];
            $r->tanggung_jawab=(double)@$data['new_data']['tanggung_jawab'];
            $r->ketaatan=(double)@$data['new_data']['ketaatan'];
            $r->kejujuran=(double)@$data['new_data']['kejujuran'];
            $r->kerjasama=(double)@$data['new_data']['kerjasama'];
            $r->prakarsa=(double)@$data['new_data']['prakarsa'];
            $r->kepemimpinan=(double)@$data['new_data']['kepemimpinan'];
            $r->tahun=(double)@$data['new_data']['tahun'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatDp3::where("id", @$data["id"])->get()->first();

            $r->kesetiaan=(double)@$data['new_data']['kesetiaan'];
            $r->prestasi=(double)@$data['new_data']['prestasi'];
            $r->tanggung_jawab=(double)@$data['new_data']['tanggung_jawab'];
            $r->ketaatan=(double)@$data['new_data']['ketaatan'];
            $r->kejujuran=(double)@$data['new_data']['kejujuran'];
            $r->kerjasama=(double)@$data['new_data']['kerjasama'];
            $r->prakarsa=(double)@$data['new_data']['prakarsa'];
            $r->kepemimpinan=(double)@$data['new_data']['kepemimpinan'];
            $r->tahun=(double)@$data['new_data']['tahun'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
