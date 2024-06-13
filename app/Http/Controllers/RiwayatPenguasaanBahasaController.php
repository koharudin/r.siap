<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPenguasaanBahasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPenguasaanBahasaController extends Controller
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
        $employee = Employee::with(['obj_riwayat_penguasaanbahasa'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_penguasaanbahasa()->getQuery()->with(['obj_jenis_bahasa','obj_kemampuan_bicara'])->paginate());
  
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
     * @param  \App\Models\RiwayatPenguasaanBahasa  $riwayat_penguasaanbahasa
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPenguasaanBahasa $riwayat_penguasaanbahasa)
    {
        //
        return response()->json($riwayat_penguasaanbahasa);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPenguasaanBahasa  $riwayat_penguasaanbahasa
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPenguasaanBahasa $riwayat_penguasaanbahasa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPenguasaanBahasa  $riwayat_penguasaanbahasa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPenguasaanBahasa $riwayat_penguasaanbahasa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPenguasaanBahasa  $riwayat_penguasaanbahasa
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPenguasaanBahasa $riwayat_penguasaanbahasa)
    {
        //
    }
}
