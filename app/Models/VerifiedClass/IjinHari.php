<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatIzin;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Exception;

class IjinHari extends AcceptedClass {
    public function hook(Request $request){
        $data = $request->data;
        if($request->action==1) { //tambah
           
            $e = Employee::where("id",$request->employee_id)->get()->first();
            if(!$e){
                throw new Exception("Pegawai tidak ditemukan");
            }
            $ep = EmployeePresensi::where("nipp", $e->nip_baru)->get()->first();
            if(!$ep){
                throw new Exception("Pegawai Presensi tidak ditemukan");
            }
            $r = new RiwayatIzin();
            $r->no_pekerja = $ep->nomor_pekerja;
            $r->tgl_mulai =  @$data['new_data']['tgl_mulai'];
            $r->tgl_selesai =  @$data['new_data']['tgl_selesai'];
            $r->no_sk = "";
            $r->save();
        }
    }
}