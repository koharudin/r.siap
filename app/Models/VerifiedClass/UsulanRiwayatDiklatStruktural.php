<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatDiklatStruktural;
use Exception;

class UsulanRiwayatDiklatStruktural extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatDiklatStruktural::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah
            $r = new RiwayatDiklatStruktural();
            $r->jenis_diklat_siasn=@$data['new_data']['jenis_diklat_siasn'];
            $r->nama_diklat=@$data['new_data']['nama_diklat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->angkatan=@$data['new_data']['angkatan'];
            $r->no_sttpp=@$data['new_data']['no_sttpp'];
            $r->tgl_sttpp=@$data['new_data']['tgl_sttpp'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            


            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit

            $r = RiwayatDiklatStruktural::where("id", @$data["id"])->get()->first();
            $r->jenis_diklat_siasn=@$data['new_data']['jenis_diklat_siasn'];
            $r->nama_diklat=@$data['new_data']['nama_diklat'];
            $r->penyelenggara=@$data['new_data']['penyelenggara'];
            $r->tempat=@$data['new_data']['tempat'];
            $r->angkatan=@$data['new_data']['angkatan'];
            $r->no_sttpp=@$data['new_data']['no_sttpp'];
            $r->tgl_sttpp=@$data['new_data']['tgl_sttpp'];
            $r->tahun=@$data['new_data']['tahun'];
            $r->tgl_mulai=@$data['new_data']['tgl_mulai'];
            $r->tgl_selesai=@$data['new_data']['tgl_selesai'];
            

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
