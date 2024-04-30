<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatDiklatFungsional;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatDiklatFungsionalController extends Controller
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
        $employee = Employee::with(['obj_riwayat_diklat_fungsional'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_diklat_fungsional);
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
     * @param  \App\Models\RiwayatDiklatFungsional  $riwayatDiklatFungsional
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatDiklatFungsional $riwayatDiklatFungsional)
    {
        //
        return response()->json($riwayatDiklatFungsional);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatDiklatFungsional  $riwayatDiklatFungsional
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatDiklatFungsional $riwayatDiklatFungsional)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatDiklatFungsional  $riwayatDiklatFungsional
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatDiklatFungsional $riwayatDiklatFungsional)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatDiklatFungsional  $riwayatDiklatFungsional
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatDiklatFungsional $riwayatDiklatFungsional)
    {
        //
    }
}
