<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatIzin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresensiIzinController extends Controller
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
        $employee = EmployeePresensi::with(['obj_riwayat_izin'])->whereRaw('nipp = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_izin);
  
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
     * @param  \App\Models\Presensi\RiwayatIzin  $riwayatIzin
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatIzin $riwayatIzin)
    {
        //
        return response()->json($riwayatIzin);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi\RiwayatIzin  $riwayatIzin
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatIzin $riwayatIzin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi\RiwayatIzin  $riwayatIzin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatIzin $riwayatIzin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi\RiwayatIzin  $riwayatIzin
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatIzin $riwayatIzin)
    {
        //
    }
}
