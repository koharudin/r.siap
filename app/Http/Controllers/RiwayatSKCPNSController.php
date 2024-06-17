<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatSKCPNS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatSKCPNSController extends Controller
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
        $employee = Employee::with(['obj_riwayat_skcpns'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_skcpns()->orderBy('tmt_cpns','desc')->first());

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
     * @param  \App\Models\RiwayatSKCPNS  $riwayat_skcpn
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatSKCPNS $riwayat_skcpn)
    {
        //
        return response()->json($riwayat_skcpn);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatSKCPNS  $riwayat_skcpn
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatSKCPNS $riwayat_skcpn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatSKCPNS  $riwayat_skcpn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatSKCPNS $riwayat_skcpn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatSKCPNS  $riwayat_skcpn
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatSKCPNS $riwayat_skcpn)
    {
        //
    }
}
