<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatUjiKompetensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatUjiKompetensiController extends Controller
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
        $employee = Employee::with(['obj_riwayat_ujikompetensi'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_ujikompetensi()->paginate());
 
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
     * @param  \App\Models\RiwayatUjiKompetensi  $riwayat_ujikompetensi
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatUjiKompetensi $riwayat_ujikompetensi)
    {
        //
        return response()->json($riwayat_ujikompetensi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatUjiKompetensi  $riwayat_ujikompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatUjiKompetensi $riwayat_ujikompetensi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatUjiKompetensi  $riwayat_ujikompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatUjiKompetensi $riwayat_ujikompetensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatUjiKompetensi  $riwayat_ujikompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatUjiKompetensi $riwayat_ujikompetensi)
    {
        //
    }
}
