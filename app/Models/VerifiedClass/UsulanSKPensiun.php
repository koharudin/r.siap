<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatPensiun;
use Exception;

class UsulanSKPensiun extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 2) { //edit
            $r = RiwayatPensiun::where("employee_id", $request->employee_id)->get()->first();
            if (!$r) {
                $r = new RiwayatPensiun();
                $r->employee_id =  $request->employee_id;
            }
            $r->no_bkn=@$data['new_data']['no_bkn'];
            $r->tgl_bkn=@$data['new_data']['tgl_bkn'];
            $r->no_sk=@$data['new_data']['no_sk'];
            $r->tgl_pensiun=@$data['new_data']['tgl_pensiun'];
            $r->tmt_pensiun=@$data['new_data']['tmt_pensiun'];
            $r->pangkat_id=@$data['new_data']['pangkat_id'];
            //$r->pangkat_text=@$data['new_data']['pangkat_text'];
            $r->masa_kerja_tahun=@$data['new_data']['masa_kerja_tahun'];
            $r->masa_kerja_bulan=@$data['new_data']['masa_kerja_bulan'];
            $r->unit_kerja_id=@$data['new_data']['unitkerja_id'];
            $r->unit_kerja=@$data['new_data']['unitkerja_text'];            

            $r->save();
        }
    }
}
