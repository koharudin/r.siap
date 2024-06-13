<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPangkatController extends Controller
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
        $employee = Employee::with(['obj_riwayat_pangkat'])->whereRaw('nip_baru = ?', [$user->username])->first();
        return response()->json($employee->obj_riwayat_pangkat()->with(['obj_pangkat','obj_jenis_kenaikan_pangkat'])->paginate());
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
     * @param  \App\Models\RiwayatPangkat  $riwayatPangkat
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPangkat $riwayatPangkat)
    {
        //
        return response()->json($riwayatPangkat);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPangkat  $riwayatPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPangkat $riwayatPangkat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPangkat  $riwayatPangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPangkat $riwayatPangkat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPangkat  $riwayatPangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPangkat $riwayatPangkat)
    {
        //
    }
}
