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

class DaftarUsulanController extends Controller
{
    public function list()
    {
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();

        return response()->json($employee->obj_requests()->getQuery()->with(['obj_status', 'obj_kategori'])->orderBy('created_at', 'desc')->paginate());
    }
    public function store()
    {
        $action = request()->input("action");
        $id = request()->input("id");
        $layanan_id  = request()->input("layanan_id");
        $ref_data = json_decode(request()->input("ref_data"));
        $new_data = json_decode(request()->input("new_data"));
        DB::beginTransaction();
        $user = FacadesAuth::user();
        $employee = Employee::with(['obj_requests'])->whereRaw('nip_baru = ?', [$user->username])->first();
        try {
            $request = new RequestPelayanan();
            $request->data = [
                "action" => $action,
                "id" => $id,
                "ref_data" =>$ref_data,
                "new_data" => $action==3?$ref_data:$new_data
            ];
            $request->action = $action;
            $request->category_id = $layanan_id;
            $request->employee_id =  $employee->id;
            $request->creator = $user->id;
            $request->status_id = StatusUsulan::SEND;
            $request->save();

            $requestLog = new RequestLog();
            $requestLog->user_id = $user->id;
            $requestLog->request_id = $request->id;
            $requestLog->values = [
                "status_id"=>StatusUsulan::SEND,
                "keterangan"=>"Pembuatan Usulan ",
                "ref_data" =>$ref_data,
                "new_data" => $action==3?$ref_data:$new_data
            ];
            $requestLog->save();
            DB::commit();
            return response()->json([
                "uuid"=>$request->uuid
            ], 200);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return response()->json("Tidak dapat menyimpan ke database <br>".$e->getMessage(),500);
        }
    }
    public function detail($uuid)
    {
        $request = RequestPelayanan::where("uuid", $uuid)->with(['obj_status', 'obj_kategori', 'obj_employee', 'obj_logs','obj_logs.obj_user'])->first();
        if ($request) {
            return response()->json(["uuid" => $uuid, "data" => $request], 200);
        }
        return response()->json(["uuid" => $uuid], 404);
    }
    public function hapus($uuid)
    {
        $request = RequestPelayanan::where("uuid", $uuid)->first();
        if ($request) {
            $request->delete();
            return response()->json(["uuid" => $uuid, "data" => $request], 200);
        }
        return response()->json(["uuid" => $uuid], 404);
    }
}
