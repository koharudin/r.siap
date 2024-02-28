<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestPelayanan;
use App\Models\RequestLog;
use App\Models\RequestStep;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
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
        $query = RequestPelayanan::query();
        $query->where('employee_id', $user->id);
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
        $validator = Validator::make(request()->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $record = new RequestPelayanan();
        $record->creator = Auth::user()->id;
        $record->employee_id = Auth::user()->id;
        $record->category_id = 1;
        $record->status_id = RequestStep::$DRAFT;
        $record->date_created = Carbon::now();
        $record->old_data = [];
        $record->request_data = [];
        $record->save();

        return response()->json($record, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(RequestPelayanan $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestPelayanan $request)
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
    public function update(Request $requestx, RequestPelayanan $request)
    {
        //
        $validator = Validator::make(request()->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $request->creator = Auth::user()->id;
        $request->employee_id = Auth::user()->id;
        $request->category_id = 1;
        $request->status_id = RequestStep::$DRAFT;
        $request->date_created = Carbon::now();
        $request->old_data = [];
        $request->request_data = [];
        $request->save();

        return response()->json($request, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(RequestPelayanan $request)
    {
        $request->delete();
        return response()->json($request, 200);
    }
}
