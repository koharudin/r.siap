<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\PengembanganKompetensiPlan;
use App\Models\Presensi\RiwayatPejaker;
use App\Models\Presensi\RiwayatSesiKerja;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Carbon\Carbon;
use Exception;

class PengembanganKompetensi extends AcceptedClass
{
    public function checkSubmit()
    {
        $user = auth()->user();
    }
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 1) { //tambah

            $e = Employee::where("id", $request->employee_id)->get()->first();
            if (!$e) {
                throw new Exception("Pegawai tidak ditemukan");
            }
            $record = PengembanganKompetensiPlan::where("request_id", $request->id)->get()->first();
            if (!$record) {
                $record = new PengembanganKompetensiPlan();
                $record->request_id = $request->id;
            }

            $data = $request->data;
            $record->first_name = $data["new_data"]["data_diri"]["first_name"];
            $record->nip_baru = @$data["new_data"]["data_diri"]["nip_baru"];
            $record->pangkat_golongan = @$data["new_data"]["data_diri"]["pangkat_golongan"];
            $record->jabatan_text = @$data["new_data"]["data_diri"]["jabatan_text"];
            $record->unit_organisasi_text = @$data["new_data"]["data_diri"]["unit_organisasi_text"];
            $record->pendidikan_terakhir_text = @$data["new_data"]["data_diri"]["pendidikan_terakhir_text"];
            $record->kebutuhan_program_pendidikan = @$data["new_data"]["kebutuhan_program_pendidikan"];
            $record->jurusan_pendidikan = @$data["new_data"]["jurusan_pendidikan"];
            $record->tahun = @$data["new_data"]["tahun"];
            $record->rencana_pembiayaan = @$data["new_data"]["rencana_pembiayaan"];
            $record->saran_pengembangan_kompetensi_pendidikan = @$data["new_data"]["saran_pengembangan_kompetensi_pendidikan"];
            $record->manso_pernah = @$data["new_data"]["manso_pernah"];
            $record->manso_tanggal = @$data["new_data"]["manso_tanggal"];
            $record->manso_hasil = @$data["new_data"]["manso_hasil"];
            $record->kebutuhan_manso = @$data["new_data"]["kebutuhan_manso"];
            $record->komtek_hasil = @$data["new_data"]["komtek_hasil"];
            $record->kebutuhan_komtek = @$data["new_data"]["kebutuhan_komtek"];
            $record->saran_pengembangan_kompetensi_pelatihan = @$data["new_data"]["saran_pengembangan_kompetensi_pelatihan"];
            $record->kebutuhan_pengembangan = @$data["new_data"]["kebutuhan_pengembangan"];

            $extraData = request()->input('extraData');
            if ($extraData) {
                $jsonExtraData = json_decode($extraData);
                $record->catatan_atasan_validasi = $jsonExtraData->catatan_atasan_validasi;
                $record->catatan_atasan_rekomendasi = $jsonExtraData->catatan_atasan_rekomendasi;
            }
            $record->save();
        }
    }
}
