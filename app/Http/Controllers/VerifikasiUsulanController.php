<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\LineApproval;
use App\Models\Request as RequestPelayanan;
use App\Models\RequestLog;
use App\Models\RequestStep;
use App\Models\RiwayatUsulan;
use App\Models\StatusUsulan;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VerifikasiUsulanController extends Controller
{
    public function list()
    {
        $list = RequestPelayanan::with(['obj_status','obj_employee', 'obj_kategori']);
        return response()->json($list->orderBy('created_at', 'desc')->paginate());
    }
    public function verifikasi()
    {
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();

        return response()->json($employee->obj_requests()->getQuery()->with(['obj_status', 'obj_kategori'])->orderBy('created_at', 'desc')->paginate());
    }
}
