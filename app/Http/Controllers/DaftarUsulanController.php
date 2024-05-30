<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LineApproval;
use App\Models\Request as RequestPelayanan;
use App\Models\RequestLog;
use App\Models\RequestStep;
use App\Models\RiwayatUsulan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DaftarUsulanController extends Controller
{
    public function list(){
        $user = FacadesAuth::user();
        $list_usulan = RiwayatUsulan::query()->paginate(10);
        return response()->json($list_usulan);
    }
    public function createBaru($tipe){
        return response()->json("ok",200);
    }

}
