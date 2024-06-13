<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatGaji;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatGajiController extends Controller
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
        $employee = Employee::with(['obj_riwayat_gaji'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_gaji()->with(['objJenisKenaikanGaji'])->paginate());
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
     * @param  \App\Models\RiwayatGaji  $riwayatGaji
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatGaji $riwayatGaji)
    {
        //
        return response()->json($riwayatGaji);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatGaji  $riwayatGaji
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatGaji $riwayatGaji)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatGaji  $riwayatGaji
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatGaji $riwayatGaji)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatGaji  $riwayatGaji
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatGaji $riwayatGaji)
    {
        //
    }
}
