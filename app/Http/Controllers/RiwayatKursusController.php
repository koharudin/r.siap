<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatKursus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatKursusController extends Controller
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
        $employee = Employee::with(['obj_riwayat_kursus'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_kursus);
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
     * @param  \App\Models\RiwayatKursus  $riwayatKursu
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatKursus $riwayatKursu)
    {
        //
        return response()->json($riwayatKursu);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatKursus  $riwayatKursu
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatKursus $riwayatKursu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatKursus  $riwayatKursu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatKursus $riwayatKursu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatKursus  $riwayatKursu
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatKursus $riwayatKursu)
    {
        //
    }
}
