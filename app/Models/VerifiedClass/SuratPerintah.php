<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatIzin;
use App\Models\Presensi\RiwayatPejaker;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;

class SuratPerintah extends AcceptedClass
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
        $tgl_mulai = json_decode(request()->input("tgl_mulai"));
        $tgl_selesai = json_decode(request()->input("tgl_selesai"));
        foreach ($new_data->employees as $employee) {
            $ep = EmployeePresensi::where("nipp", $employee->nip_baru)->get()->first();
            $c = DB::connection("db_presensi")->select("CALL cek_ijin(?,?,?, ?,?) ", array($ep->nomor_pekerja, $tgl_mulai, $tgl_selesai, 1, 1));
            $result =  $c[0]->cek;
            if ($result == 0) {
                throw new Exception("Pegawai sudah ada ijin dalam tanggal tersebut");
            }
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


            $employees = @$data['new_data']['employees'];
            if (!$employees) {
                throw new Exception("Tidak ada daftar pegawai");
            }
            $tgl_mulai =  @$data['new_data']['tgl_mulai'];
            $tgl_selesai =  @$data['new_data']['tgl_selesai'];
            foreach($employees as $employee){
                $e = Employee::whereRaw('nip_baru = ?', [$employee["nip_baru"]])->first();
                if (!$e) {
                    throw new Exception("Pegawai tidak ditemukan");
                }
                $ep = EmployeePresensi::where("nipp", $e->nip_baru)->get()->first();
                if (!$ep) {
                    throw new Exception("Pegawai Presensi tidak ditemukan");
                }
                $c = DB::connection("db_presensi")->select("CALL cek_ijin(?,?,?, ?,?) ", array($ep->nomor_pekerja, $tgl_mulai, $tgl_selesai, 1, 1));
                $result =  $c[0]->cek;
                if ($result == 0) {
                    throw new Exception("Pegawai sudah ada ijin dalam tanggal tersebut");
                }
            }

            foreach ($employees as $employee) {
                $r = new RiwayatIzin();
                $ep = EmployeePresensi::where("nipp", @$employee['nip_baru'])->get()->first();
                $r->no_pekerja = $ep->nomor_pekerja;
                $r->no_sk = @$data['new_data']['no_sk'];
                $r->tgl_sk = @$data['new_data']['tgl_sk'];
                $r->tgl_mulai = @$data['new_data']['tgl_mulai'];
                $r->no_pemberiTugas = @$data['new_data']['assigner_nip'];
                $r->keterangan = @$data['new_data']['assigner_nip'];
                $r->save();
            }
        }
    }
}
