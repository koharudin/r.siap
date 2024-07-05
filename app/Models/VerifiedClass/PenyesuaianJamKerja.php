<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatPejaker;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Carbon\Carbon;
use Exception;

class PenyesuaianJamKerja extends AcceptedClass
{
    public function checkSubmit()
    {
        $user = auth()->user();
        $e = Employee::whereRaw('nip_baru = ?', [$user->username])->first();
        if (!$e) {
            throw new Exception("Pegawai tidak ditemukan");
        }
        $ep = EmployeePresensi::where("nipp", $e->nip_baru)->get()->first();
        if (!$ep) {
            throw new Exception("Pegawai Presensi tidak ditemukan");
        }
        $new_data = json_decode(request()->input("new_data"));
        $r = RiwayatPejaker::where("no_pekerja", $ep->nomor_pekerja)->whereRaw("date(tgl_pejaker) = ?", [ $new_data->tgl_pejaker])->get()->first();

        if ($r) {
            throw new Exception("Sudah ada data penyesuaian jam kerja pada tanggal tersebut");
        }
    }
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
            $r = RiwayatPejaker::where("no_pekerja", $ep->nomor_pekerja)->whereRaw("date(tgl_pejaker) = ?", [@$data['new_data']['tgl_pejaker']])->get()->first();
            if ($r) {
                throw new Exception("Sudah ada data penyesuaian jam kerja pada tanggal tersebut");
            } else {
                $r = new RiwayatPejaker();
                $r->no_pekerja = $ep->nomor_pekerja;
                $r->no_sk = @$data['new_data']['no_sk'];
                $r->tgl_sk = @$data['new_data']['tgl_sk'];
                $r->alasan = @$data['new_data']['alasan'];
                $r->tgl_pejaker = @$data['new_data']['tgl_pejaker'];
                $r->jenis = @$data['new_data']['jenis'];
                $r->jam_masuk = @$data['new_data']['jam_masuk'];
                $r->jam_keluar = @$data['new_data']['jam_keluar'];
                $r->save();
            }
        }
    }
}
