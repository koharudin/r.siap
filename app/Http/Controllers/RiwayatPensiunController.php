<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPensiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPensiunController extends Controller
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
        $employee = Employee::with(['obj_riwayat_pensiun'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_pensiun()->paginate());

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
     * @param  \App\Models\RiwayatPensiun  $riwayatPensiun
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPensiun $riwayatPensiun)
    {
        //
        return response()->json($riwayatPensiun);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPensiun  $riwayatPensiun
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPensiun $riwayatPensiun)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPensiun  $riwayatPensiun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPensiun $riwayatPensiun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPensiun  $riwayatPensiun
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPensiun $riwayatPensiun)
    {
        //
    }
}
