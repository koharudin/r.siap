<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatSesiKerja;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresensiSesiKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($use_response=true)
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
        $employee = EmployeePresensi::with(['obj_riwayat_sesikerja'=>function($query) use($tahun,$bulan){
            $dt = Carbon::now();
            $dt->setTime(0,0,0);
            $dt->setYear($tahun);
            $dt->setMonth($bulan);
            $dt->setDay(1);
            $dt_from = $dt->format("Y-m-d");
            $dt->addMonth(1);
            $dt->setDay(-1);
            $dt_to= $dt->format("Y-m-d");
            $query->where(function($query) use($dt_from,$dt_to){
                $query->whereRaw("? between mulai and selesai",[$dt_from]);
                $query->OrwhereRaw("mulai between ? and ?",[$dt_from,$dt_to]);
                $query->OrWhereRaw("? between mulai and selesai",[$dt_to]);
                $query->OrwhereRaw("selesai between ? and ?",[$dt_from,$dt_to]);
            });
           
        }])->whereRaw('nipp = ?',[$user->username])->first();
        if($use_response){
            return response()->json($employee->obj_riwayat_sesikerja);
        }
        else return $employee->obj_riwayat_sesikerja;
        
  
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
     * @param  \App\Models\Presensi\RiwayatSesiKerja  $riwayat_sesikerja
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatSesiKerja $riwayat_sesikerja)
    {
        //
        return response()->json($riwayat_sesikerja);
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi\RiwayatSesiKerja  $riwayat_sesikerja
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatSesiKerja $riwayat_sesikerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi\RiwayatSesiKerja  $riwayat_sesikerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatSesiKerja $riwayat_sesikerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi\RiwayatSesiKerja  $riwayat_sesikerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatSesiKerja $riwayat_sesikerja)
    {
        //
    }
}
