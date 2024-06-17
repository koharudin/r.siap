<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Carbon\Carbon;
use Exception;

class DataTidakTerekam extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 1) { //tambah

            $e = Employee::where("id", $request->employee_id)->get()->first();
            if (!$e) {
                throw new Exception("Pegawai tidak ditemukan");
            }
            $ep = EmployeePresensi::where("nipp", $e->nip_baru)->get()->first();
            if (!$ep) {
                throw new Exception("Pegawai Presensi tidak ditemukan");
            }
            $r = RiwayatSesiKerja::where("no_pekerja", $ep->nomor_pekerja)->whereRaw("date(mulai) = ?", [@$data['new_data']['tgl']])->get()->first();
            if (!$r) {
                $r = new RiwayatSesiKerja();
                $r->no_pekerja = $ep->nomor_pekerja;
                $r->mulai =  @$data['new_data']['tgl'] . " " . @$data['new_data']['time'];
                $r->selesai =  @$data['new_data']['tgl'] . " " . @$data['new_data']['time'];
                $r->save();
            } else {
                $str = @$data['new_data']['tgl'] . " " . @$data['new_data']['time'];
                $dt = Carbon::createFromFormat("Y-m-d H:i", $str);
                if ($dt->lt($r->mulai)) {
                    $r->mulai = $dt;
                } 
                if ($dt->gt($r->selesai)) {
                    $r->selesai = $dt;
                }
                $r->save();
            }
        }
    }
}
