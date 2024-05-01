<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatNikah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatNikahController extends Controller
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
        $employee = Employee::with(['obj_riwayat_nikah'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_nikah);
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
     * @param  \App\Models\RiwayatNikah  $riwayatNikah
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatNikah $riwayatNikah)
    {
        //
        return response()->json($riwayatNikah);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatNikah  $riwayatNikah
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatNikah $riwayatNikah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatNikah  $riwayatNikah
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatNikah $riwayatNikah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatNikah  $riwayatNikah
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatNikah $riwayatNikah)
    {
        //
    }
}
