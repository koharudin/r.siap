<?php

namespace App\Http\Controllers;

use App\Models\LineApproval;
use App\Models\Request as RequestPelayanan;
use App\Models\RequestLog;
use App\Models\RequestStep;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LineApprovalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $q = request()->input('q');
        $user = Auth::user();
        $query = LineApproval::query();
        //$query->where('employee_id', $user->id);
        $query->orderBy('updated_at', 'DESC');
        if ($q) {
            // $query->where(function ($query) use ($q) {
            //     $query->where('name', 'ilike', "%" . strtolower($q) . "%");
            //     $query->Orwhere('url', 'ilike', "%" . strtolower($q) . "%");
            // });
        }

        return $query->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'request_category_id' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $record = new LineApproval();
        $record->request_category_id = request()->input("request_category_id");
        $record->approval_hierarchy = [];
        $record->save();

        return response()->json($record, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(LineApproval $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(LineApproval $request)
    {
        return response()->json($request, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requestx, LineApproval $request)
    {
        //
        $validator = Validator::make(request()->all(), [
            "request_category_id" => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $record->request_category_id = request()->input("request_category_id");
        $record->approval_hierarchy = [];
        $request->save();

        return response()->json($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(LineApproval $request)
    {
        $request->delete();
        return response()->json($request, 200);
    }
}
