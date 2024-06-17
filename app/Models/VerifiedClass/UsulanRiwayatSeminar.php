<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatSeminar;
use App\Models\RiwayatPotensiDiri;
use Exception;

class UsulanRiwayatSeminar extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatSeminar::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatSeminar();
            $r->nama=@$data['new_data']['nama'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->no_piagam=@$data['new_data']['no_piagam'];
            $r->tgl_piagam=@$data['new_data']['tgl_piagam'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            $r->jumlah_jam=@$data['new_data']['jumlah_jam'];
            $r->status=@$data['new_data']['status'];
            $r->peran=@$data['new_data']['peran'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatSeminar::where("id", @$data["id"])->get()->first();
            $r->nama=@$data['new_data']['nama'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->no_piagam=@$data['new_data']['no_piagam'];
            $r->tgl_piagam=@$data['new_data']['tgl_piagam'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            $r->jumlah_jam=@$data['new_data']['jumlah_jam'];
            $r->status=@$data['new_data']['status'];
            $r->peran=@$data['new_data']['peran'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
