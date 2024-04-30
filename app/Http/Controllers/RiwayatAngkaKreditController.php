<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatAngkaKredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatAngkaKreditController extends Controller
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
        $employee = Employee::with(['obj_riwayat_angkakredit'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_angkakredit);
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
     * @param  \App\Models\RiwayatAngkaKredit  $riwayatAngkaKredit
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatAngkaKredit $riwayatAngkaKredit)
    {
        //
        return response()->json($riwayatAngkaKredit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatAngkaKredit  $riwayatAngkaKredit
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatAngkaKredit $riwayatAngkaKredit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatAngkaKredit  $riwayatAngkaKredit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatAngkaKredit $riwayatAngkaKredit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatAngkaKredit  $riwayatAngkaKredit
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatAngkaKredit $riwayatAngkaKredit)
    {
        //
    }
}
