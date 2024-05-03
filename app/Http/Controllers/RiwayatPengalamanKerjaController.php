<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPengalamanKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPengalamanKerjaController extends Controller
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
        $employee = Employee::with(['obj_riwayat_pengalamankerja'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_pengalamankerja);
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
     * @param  \App\Models\RiwayatPengalamanKerja  $riwayat_pengalamankerja
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPengalamanKerja $riwayat_pengalamankerja)
    {
        //
        return response()->json($riwayat_pengalamankerja);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPengalamanKerja  $riwayat_pengalamankerja
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPengalamanKerja $riwayat_pengalamankerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPengalamanKerja  $riwayat_pengalamankerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPengalamanKerja $riwayat_pengalamankerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPengalamanKerja  $riwayat_pengalamankerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPengalamanKerja $riwayat_pengalamankerja)
    {
        //
    }
}
