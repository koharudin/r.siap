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
        foreach ($new_data->employees as $employee) {
            $ep = EmployeePresensi::where("nipp", $employee->nip_baru)->get()->first();
            //RiwayatIzin::where("no_pekerja")
            //throw new Exception ("employee ".$employee->nip_baru);
        }
        //throw new Exception ("cek surat perintah");
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
            foreach ($employees as $employee) {
                $r = new RiwayatIzin();
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
