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

    public function tolak(ModelsRequest $request)
    {
        $validator = Validator::make(request()->all(), [
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        DB::beginTransaction();
        $request->status_id = RequestStep::$TOLAK;
        $request->verifikator_id  = Auth::user()->id;
        $request->save();
        RequestLog::addLog($request, request()->input("keterangan"));
        DB::commit();
        return response()->json($request, 200);
    }
    public function terima(ModelsRequest $request)
    {
        $validator = Validator::make(request()->all(), [
            'keterangan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        DB::beginTransaction();
        $request->status_id = RequestStep::$TERIMA;
        $request->verifikator_id  = Auth::user()->id;
        $request->save();
        RequestLog::addLog($request, request()->input("keterangan"));
        DB::commit();
        return response()->json($request, 200);
    }
}
