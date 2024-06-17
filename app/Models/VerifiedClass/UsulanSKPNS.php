<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatSKPNS;
use Exception;

class UsulanSKPNS extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 2) { //edit
            $r = RiwayatSKPNS::where("employee_id", $request->employee_id)->get()->first();
            if (!$r) {
                $r = new RiwayatSKPNS();
                $r->employee_id =  $request->employee_id;
            }
            $r->no_sk = @$data['new_data']['no_sk'];
            $r->tgl_sk = @$data['new_data']['tgl_sk'];
            $r->tmt_pns = @$data['new_data']['tmt_pns'];
            $r->pejabat_penetap_id = @$data['new_data']['pejabat_penetap_id'];
            $r->pejabat_penetap_jabatan = @$data['new_data']['pejabat_penetap_jabatan'];
            $r->pejabat_penetap_nip = @$data['new_data']['pejabat_penetap_nip'];
            $r->pejabat_penetap_nama = @$data['new_data']['pejabat_penetap_nama'];
            $r->pangkat_id = @$data['new_data']['pangkat_id'];
            $r->sumpah = @$data['new_data']['sumpah'];
            $r->no_ujikes = @$data['new_data']['no_ujikes'];
            $r->tgl_ujikes = @$data['new_data']['tgl_ujikes'];
            $r->no_prajab = @$data['new_data']['no_prajab'];
            $r->tgl_prajab = @$data['new_data']['tgl_prajab'];


            $r->save();
        }
    }
}
