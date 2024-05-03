<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatRekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatRekamMedisController extends Controller
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
        $employee = Employee::with(['obj_riwayat_rekammedis'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_rekammedis);

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
     * @param  \App\Models\RiwayatRekamMedis  $riwayat_rekammedi
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatRekamMedis $riwayat_rekammedi)
    {
        //
        return response()->json($riwayat_rekammedi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatRekamMedis  $riwayat_rekammedi
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatRekamMedis $riwayat_rekammedi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatRekamMedis  $riwayat_rekammedi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatRekamMedis $riwayat_rekammedi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatRekamMedis  $riwayat_rekammedi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatRekamMedis $riwayat_rekammedi)
    {
        //
    }
}
