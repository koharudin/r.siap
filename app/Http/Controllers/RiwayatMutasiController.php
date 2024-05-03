<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatMutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatMutasiController extends Controller
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
        $employee = Employee::with(['obj_riwayat_mutasi'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_mutasi);
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
     * @param  \App\Models\RiwayatMutasi  $riwayatMutasi
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatMutasi $riwayatMutasi)
    {
        //
        return response()->json($riwayatMutasi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatMutasi  $riwayatMutasi
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatMutasi $riwayatMutasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatMutasi  $riwayatMutasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatMutasi $riwayatMutasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatMutasi  $riwayatMutasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatMutasi $riwayatMutasi)
    {
        //
    }
}
