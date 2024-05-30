<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatDiklatStruktural;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatDiklatStrukturalController extends Controller
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
        $employee = Employee::with(['obj_riwayat_diklat_struktural'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_diklat_struktural()->paginate(-1));
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
     * @param  \App\Models\RiwayatDiklatStruktural  $riwayatDiklatStruktural
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatDiklatStruktural $riwayatDiklatStruktural)
    {
        //
        return response()->json($riwayatDiklatStruktural);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatDiklatStruktural  $riwayatDiklatStruktural
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatDiklatStruktural $riwayatDiklatStruktural)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatDiklatStruktural  $riwayatDiklatStruktural
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatDiklatStruktural $riwayatDiklatStruktural)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatDiklatStruktural  $riwayatDiklatStruktural
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatDiklatStruktural $riwayatDiklatStruktural)
    {
        //
    }
}
