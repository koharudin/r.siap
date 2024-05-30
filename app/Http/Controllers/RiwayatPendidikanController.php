<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $employee = Employee::with(['obj_riwayat_pendidikan'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_pendidikan()->paginate());
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
     * @param  \App\Models\RiwayatPendidikan  $riwayatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPendidikan $riwayatPendidikan)
    {
        //
        return response()->json($riwayatPendidikan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPendidikan  $riwayatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPendidikan  $riwayatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPendidikan  $riwayatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPendidikan $riwayatPendidikan)
    {
        //
    }
}
