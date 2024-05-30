<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatAnak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatAnakController extends Controller
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
        $employee = Employee::with(['obj_riwayat_anak'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_anak()->paginate(-1));
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
     * @param  \App\Models\RiwayatAnak  $riwayatAnak
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatAnak $riwayatAnak)
    {
        //
        return response()->json($riwayatAnak);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatAnak  $riwayatAnak
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatAnak $riwayatAnak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatAnak  $riwayatAnak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatAnak $riwayatAnak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatAnak  $riwayatAnak
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatAnak $riwayatAnak)
    {
        //
    }
}
