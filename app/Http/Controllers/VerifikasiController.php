<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\RequestLog;
use App\Models\RequestStep;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VerifikasiController extends Controller
{
    public function index()
    {
        $q = request()->input('q');
        $query = ModelsRequest::query();
        $query->inboxVerifikator();
        $query->orderBy('updated_at', 'DESC');
        if ($q) {
            // $query->where(function ($query) use ($q) {
            //     $query->where('name', 'ilike', "%" . strtolower($q) . "%");
            //     $query->Orwhere('url', 'ilike', "%" . strtolower($q) . "%");
            // });
        }

        return $query->paginate(10);
    }
    public function inboxku()
    {
        $q = request()->input('q');
        $query = ModelsRequest::query();
        $query->inboxKuVerifikator();
        $query->orderBy('updated_at', 'DESC');
        if ($q) {
            // $query->where(function ($query) use ($q) {
            //     $query->where('name', 'ilike', "%" . strtolower($q) . "%");
            //     $query->Orwhere('url', 'ilike', "%" . strtolower($q) . "%");
            // });
        }

        return $query->paginate(10);
    }
    public function doVerify(ModelsRequest $request)
    {
        $validator = Validator::make(request()->all(), [
            'uuid' => 'required',
            'alasan' => 'required',
            'action' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi alasan.',
            ], 422);
        }
        $record = ModelsRequest::where("uuid",request()->input("uuid"))->get()->first();
        if(!$record){
            return response()->json([
                'message' => 'Data tidak ditemukan',
            ], 422);
        }
        if($record->status_id == RequestStep::DRAFT){
            return response()->json([
                'message' => 'Status Usulan masih DRAFT',
            ], 422);
        }
        if($record->status_id == RequestStep::REVISI || $record->status_id == RequestStep::TERIMA || $record->status_id == RequestStep::TOLAK){
            return response()->json([
                'message' => 'Status Usulan SUDAH DIVERIFIKASI',
            ], 422);
        }
        if(request()->input("action")=="terima"){
            return $this->terima($record);
        }
        else if(request()->input("action")=="tolak"){
            return $this->tolak($record);
        }
    }
    public function tolak(ModelsRequest $request)
    {
        
        DB::beginTransaction();
        $request->status_id = RequestStep::TOLAK;
        $request->verifikator_id  = Auth::user()->id;
        $request->save();
        RequestLog::addLog($request, request()->input("alasan"));
        DB::commit();
        return response()->json($request, 200);
    }
    public function terima(ModelsRequest $request)
    {
        
        DB::beginTransaction();
        $request->status_id = RequestStep::TERIMA;
        $request->verifikator_id  = Auth::user()->id;
        $request->save();
        RequestLog::addLog($request, request()->input("alasan"));
        DB::commit();
        return response()->json($request, 200);
    }
}
