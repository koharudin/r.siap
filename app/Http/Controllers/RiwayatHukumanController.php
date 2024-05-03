<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatHukuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatHukumanController extends Controller
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
        $employee = Employee::with(['obj_riwayat_hukuman'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_hukuman);
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
     * @param  \App\Models\RiwayatHukuman  $riwayatHukuman
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatHukuman $riwayatHukuman)
    {
        //
        return response()->json($riwayatHukuman);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatHukuman  $riwayatHukuman
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatHukuman $riwayatHukuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatHukuman  $riwayatHukuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatHukuman $riwayatHukuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatHukuman  $riwayatHukuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatHukuman $riwayatHukuman)
    {
        //
    }
}
