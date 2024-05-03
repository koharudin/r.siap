<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPenghargaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPenghargaanController extends Controller
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
        $employee = Employee::with(['obj_riwayat_penghargaan'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_penghargaan);
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
     * @param  \App\Models\RiwayatPenghargaan  $riwayatPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPenghargaan $riwayatPenghargaan)
    {
        //
        return response()->json($riwayatPenghargaan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPenghargaan  $riwayatPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPenghargaan $riwayatPenghargaan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPenghargaan  $riwayatPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPenghargaan $riwayatPenghargaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPenghargaan  $riwayatPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPenghargaan $riwayatPenghargaan)
    {
        //
    }
}
