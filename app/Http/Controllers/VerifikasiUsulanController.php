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
use Zendesk\API\Resources\Core\Requests;

class VerifikasiUsulanController extends Controller
{
    public function list()
    {
        $list = RequestPelayanan::with(['obj_status', 'obj_employee', 'obj_kategori']);
        $list->where("status_id",">=",RequestStep::SEND);
        $list->where(function($query){
            $query->where("line_approval_type",1);
            $query->orWhere(function($query){
                $query->where("line_approval_type",3);
                $query->whereHas("obj_line_approvals",function($query){
                    $user = FacadesAuth::user();
                    $query->where("approval_assigner",$user->username);
                });
            });
        });
        $user = FacadesAuth::user();
        return response()->json($list->orderBy('created_at', 'desc')->paginate());
    }
    public function verifikasi()
    {
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();

        return response()->json($employee->obj_requests()->getQuery()->with(['obj_status', 'obj_kategori'])->orderBy('created_at', 'desc')->paginate());
    }
}
