<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatCuti;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Carbon\Carbon;
use Exception;

class UsulanCuti extends AcceptedClass
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
            $tgl_mulai  =  @$data['new_data']['tgl_mulai'];
            $tgl_selesai  =  @$data['new_data']['tgl_selesai'];
            if (!$tgl_mulai) {
                throw new Exception("Tanggal mulai wajib di isi");
            }
            if (!$tgl_selesai) {
                throw new Exception("Tanggal selesai wajib di isi");
            }
            $r = RiwayatCuti::where("no_pekerja", $ep->nomor_pekerja)->whereRaw("date(tgl_mulai) = ?", [$tgl_mulai])->whereRaw("date(tgl_selesai) = ?", [$tgl_selesai])->get()->first();
            if (!$r) {
                $r = new RiwayatCuti();
                $r->no_pekerja = $ep->nomor_pekerja;
            }
            $r->id_detail_jenis_cuti = @$data['new_data']['detail_jenis_cuti'];
            $r->tgl_mulai =   $tgl_mulai;
            $r->tgl_selesai =   $tgl_selesai;
            $r->waktu_input = date("Y-m-d H:i:s");
            $r->pegawai_input = "SYSTEM-LAYANAN #".$request->id;
            $r->save();
        }
    }
}
