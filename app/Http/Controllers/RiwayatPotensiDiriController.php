<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\RiwayatPotensiDiri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatPotensiDiriController extends Controller
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
        $employee = Employee::with(['obj_riwayat_potensidiri'])->whereRaw('nip_baru = ?',[$user->username])->first();
        return response()->json($employee->obj_riwayat_potensidiri()->paginate());

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
     * @param  \App\Models\RiwayatPotensiDiri  $riwayat_potensidiri
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatPotensiDiri $riwayat_potensidiri)
    {
        //
        return response()->json($riwayat_potensidiri);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RiwayatPotensiDiri  $riwayat_potensidiri
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatPotensiDiri $riwayat_potensidiri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RiwayatPotensiDiri  $riwayat_potensidiri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatPotensiDiri $riwayat_potensidiri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RiwayatPotensiDiri  $riwayat_potensidiri
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatPotensiDiri $riwayat_potensidiri)
    {
        //
    }
}
