<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatSeminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatSeminarController extends Controller
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
        $employee = Employee::with(['obj_riwayat_seminar'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_seminar);
 
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
     * @param  \App\Models\RiwayatSeminar  $riwayatSeminar
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatSeminar $riwayatSeminar)
    {
        //
        return response()->json($riwayatSeminar);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatSeminar  $riwayatSeminar
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatSeminar $riwayatSeminar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatSeminar  $riwayatSeminar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatSeminar $riwayatSeminar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatSeminar  $riwayatSeminar
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatSeminar $riwayatSeminar)
    {
        //
    }
}
