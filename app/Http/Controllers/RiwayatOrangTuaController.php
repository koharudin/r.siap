<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatOrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatOrangTuaController extends Controller
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
        $employee = Employee::with(['obj_riwayat_orangtua'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_orangtua);
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
     * @param  \App\Models\RiwayatOrangTua  $riwayatOrangTua
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatOrangTua $riwayat_orangtua)
    {
        //
        return response()->json($riwayat_orangtua);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatOrangTua  $riwayatOrangTua
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatOrangTua $riwayat_orangtua)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatOrangTua  $riwayatOrangTua
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatOrangTua $riwayat_orangtua)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatOrangTua  $riwayatOrangTua
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatOrangTua $riwayat_orangtua)
    {
        //
    }
}
