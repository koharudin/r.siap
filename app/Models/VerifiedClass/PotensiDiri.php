<?php

namespace App\Models\VerifiedClass;

use App\Models\AcceptedClass;
use App\Models\Request;
use App\Models\RiwayatPotensiDiri;
use Exception;

class PotensiDiri extends AcceptedClass {
    public function hook(Request $request){
        $data = $request->data;
        if($request->action==3) { //hapus
            $r = RiwayatPotensiDiri::where("id",@$data["id"])->get()->first();
            $r->delete();
        }
        else if($request->action==1) { //tambah
            $r = new RiwayatPotensiDiri(@$data['new_data']);
            $r->employee_id =  $request->employee_id;
            $r->save();
        }
        else if($request->action==2) { //edit
            $r = RiwayatPotensiDiri::where("id",@$data["id"])->get()->first();
            $r->fill(@$data['new_data']);
            $r->employee_id =  $request->employee_id;
            $r->save();
        }
    }
}