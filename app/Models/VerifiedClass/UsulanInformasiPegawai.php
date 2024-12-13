<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\Employee;
use Exception;

class UsulanInformasiPegawai extends AcceptedClass
{
    public function hook(Request $request)
    {
        $data = $request->data;
        if ($request->action == 2) { //edit
            $r = Employee::where("id", $request->employee_id)->get()->first();
            if (!$r) {
               throw new Exception("Employee tidak ditemukan");
            }
            $r->first_name = @$data['new_data']['first_name'];
            $r->last_name = @$data['new_data']['last_name'];
            $r->agama_id = @$data['new_data']['agama_id'];
            $r->nip_baru = @$data['new_data']['nip_baru'];
            $r->gelar_depan = @$data['new_data']['gelar_depan'];
            $r->gelar_belakang = @$data['new_data']['gelar_belakang'];
            $r->birth_place = @$data['new_data']['birth_place'];
            $r->birth_date = @$data['new_data']['birth_date'];
            $r->sex = @$data['new_data']['sex'];
            $r->status_kawin = @$data['new_data']['status_kawin'];
            $r->golongan_darah = @$data['new_data']['golongan_darah'];
            $r->email_kantor = @$data['new_data']['email_kantor'];
            $r->email = @$data['new_data']['email'];
            $r->foto = @$data['new_data']['foto'];
            $r->alamat = @$data['new_data']['alamat'];
            $r->alamat_domisili = @$data['new_data']['alamat_domisili'];
            $r->karpeg = @$data['new_data']['karpeg'];
            $r->taspen = @$data['new_data']['taspen'];
            $r->npwp = @$data['new_data']['npwp'];
            $r->askes = @$data['new_data']['askes'];
            $r->nik = @$data['new_data']['nik'];
            $r->no_hp = @$data['new_data']['no_hp'];

            $r->save();
        }
    }
}
