<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatKehadiran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresensiKehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        $validator = Validator::make(request()->all(), [
            'tahun' => "required",
            'bulan' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors(),
                'message' => 'Harap lengkapi data yang diperlukan.',
            ], 422);
        }
        $tahun = request() ->input("tahun");
        $bulan = request()->input("bulan");
        
        $user = Auth::user();
        $list_sesikerja = app(PresensiSesiKerjaController::class)->index(false);
        $list_izin = app(PresensiIzinController::class)->index(false);
        $list_izin_lain = app(PresensiIzinLainController::class)->index(false);
        $list_cuti = app(PresensiCutiController::class)->index(false);
        return response()->json([
            "sesikerja"=>$list_sesikerja,
            "izin"=>$list_izin,
            "izin-lain"=>$list_izin_lain,
            "cuti"=>$list_cuti
        ]);
  
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
     * @param  \App\Models\Presensi\RiwayatKehadiran  $riwayatKehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatKehadiran $riwayatKehadiran)
    {
        //
        return response()->json($riwayatKehadiran);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi\RiwayatKehadiran  $riwayatKehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatKehadiran $riwayatKehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi\RiwayatKehadiran  $riwayatKehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatKehadiran $riwayatKehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi\RiwayatKehadiran  $riwayatKehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatKehadiran $riwayatKehadiran)
    {
        //
    }
}
