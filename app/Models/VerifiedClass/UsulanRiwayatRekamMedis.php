<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatRekamMedis;
use Exception;

class UsulanRiwayatRekamMedis extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 3) { //hapus
            $r = RiwayatRekamMedis::where("id", @$data["id"])->get()->first();
            $r->delete();
        } else if ($request->action == 1) { //tambah

            $r = new RiwayatRekamMedis();

            $r->tgl_periksa = @$data['new_data']['tgl_periksa'];
            $r->keluhan = @$data['new_data']['keluhan'];
            $r->diagnosa = @$data['new_data']['diagnosa'];
            $r->jenis_pemeriksaan = @$data['new_data']['jenis_pemeriksaan'];
            $r->tindakan = @$data['new_data']['tindakan'];
            $r->dokter = @$data['new_data']['dokter'];
            $r->keterangan = @$data['new_data']['keterangan'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        } else if ($request->action == 2) { //edit
            $r = RiwayatRekamMedis::where("id", @$data["id"])->get()->first();

            $r->tgl_periksa = @$data['new_data']['tgl_periksa'];
            $r->keluhan = @$data['new_data']['keluhan'];
            $r->diagnosa = @$data['new_data']['diagnosa'];
            $r->jenis_pemeriksaan = @$data['new_data']['jenis_pemeriksaan'];
            $r->tindakan = @$data['new_data']['tindakan'];
            $r->dokter = @$data['new_data']['dokter'];
            $r->keterangan = @$data['new_data']['keterangan'];

            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}
