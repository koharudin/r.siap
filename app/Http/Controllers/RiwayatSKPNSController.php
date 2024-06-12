<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatSKPNS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatSKPNSController extends Controller
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
        $employee = Employee::with(['obj_riwayat_skpns'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_skpns);
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
     * @param  \App\Models\RiwayatSKPNS  $riwayat_skpn
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatSKPNS $riwayat_skpn)
    {
        //
        return response()->json($riwayat_skpn);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatSKPNS  $riwayat_skpn
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatSKPNS $riwayat_skpn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatSKPNS  $riwayat_skpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatSKPNS $riwayat_skpn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatSKPNS  $riwayat_skpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatSKPNS $riwayat_skpn)
    {
        //
    }
}
