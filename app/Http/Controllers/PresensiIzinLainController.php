<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use App\Models\Presensi\RiwayatIzinLain;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PresensiIzinLainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($use_response = true)
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
        $tahun = request()->input("tahun");
        $bulan = request()->input("bulan");

        $user = Auth::user();
        $employee = EmployeePresensi::with(['obj_riwayat_izin_lain' => function ($query) use ($tahun, $bulan) {
            $dt = Carbon::now();
            $dt->setTime(0, 0, 0);
            $dt->setYear($tahun);
            $dt->setMonth($bulan);
            $dt->setDay(1);
            $dt_from = $dt->format("Y-m-d");
            $dt->addMonth(1);
            $dt->setDay(-1);
            $dt_to = $dt->format("Y-m-d");
            $query->where(function ($query) use ($dt_from, $dt_to) {
                $query->whereRaw("? between tgl_mulai and tgl_selesai", [$dt_from]);
                $query->OrwhereRaw("tgl_mulai between ? and ?", [$dt_from, $dt_to]);
                $query->OrWhereRaw("? between tgl_mulai and tgl_selesai", [$dt_to]);
                $query->OrwhereRaw("tgl_selesai between ? and ?", [$dt_from, $dt_to]);
            });
        }])->whereRaw('nipp = ?', [$user->username])->first();
        if ($use_response) {
            return response()->json($employee->obj_riwayat_izin_lain);
        } else return $employee->obj_riwayat_izin_lain;
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
     * @param  \App\Models\Presensi\RiwayatIzinLain  $riwayat_izin_lain
     * @return \Illuminate\Http\Response
     */
    public function show(RiwayatIzinLain $riwayat_izin_lain)
    {
        //
        return response()->json($riwayat_izin_lain);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Presensi\RiwayatIzinLain  $riwayat_izin_lain
     * @return \Illuminate\Http\Response
     */
    public function edit(RiwayatIzinLain $riwayat_izin_lain)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Presensi\RiwayatIzinLain  $riwayat_izin_lain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RiwayatIzinLain $riwayat_izin_lain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Presensi\RiwayatIzinLain  $riwayat_izin_lain
     * @return \Illuminate\Http\Response
     */
    public function destroy(RiwayatIzinLain $riwayat_izin_lain)
    {
        //
    }
}
