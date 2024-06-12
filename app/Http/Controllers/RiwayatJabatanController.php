<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatJabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = Auth::user();
        $employee = Employee::with(['obj_riwayat_jabatan'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_jabatan()->orderBy('tmt_jabatan', 'desc')->paginate());
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatJabatan $riwayatJabatan)
    {
        //
        return response()->json($riwayatJabatan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatJabatan $riwayatJabatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatJabatan $riwayatJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatJabatan  $riwayatJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatJabatan $riwayatJabatan)
    {
        //
    }
}
