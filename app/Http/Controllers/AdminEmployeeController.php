<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeePresensi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function dataSaya()
    {
        $user = Auth::user();
        $user->load("roles");
        $employee = Employee::whereRaw('nip_baru = ?', [$user->username])->first();
        return response()->json($employee);
    }
    public function currentUser()
    {
        $user = Auth::user();
        $user->load("roles");
        $employee = Employee::whereRaw('nip_baru = ?', [$user->username])->first();
        $ep = EmployeePresensi::where("nipp", $employee->nip_baru)->get()->first();
        if (!$ep) {
            throw new Exception("Pegawai Presensi tidak ditemukan");
        }
        $tahun = date("Y");
        //get saldo cuti
        $c = DB::connection("db_presensi")->select("CALL getSisaCutiNew(?,?) ", array($ep->nomor_pekerja, $tahun));
        $saldo_cuti = $c[0]->sisa_thn0;
        return response()->json(["employee" => $employee, "saldo_cuti" => $saldo_cuti, "user" => $user->only("username", "name", "avatar", "roles")]);
    }
    public function informasiPegawai()
    {
        $user = Auth::user();
        $employee = Employee::with(["obj_riwayat_pangkat","obj_riwayat_jabatan","obj_satker","obj_riwayat_pendidikan"])->whereRaw('nip_baru = ?', [$user->username])->first();
        $ep = EmployeePresensi::where("nipp", $employee->nip_baru)->get()->first();
        if (!$ep) {
            throw new Exception("Pegawai Presensi tidak ditemukan");
        }
        $tahun = date("Y");
        //get saldo cuti
        $c = DB::connection("db_presensi")->select("CALL getSisaCutiNew(?,?) ", array($ep->nomor_pekerja, $tahun));
        $saldo_cuti = $c[0]->sisa_thn0;

        $employee_arr = $employee->toArray();
        $last_pangkat = $employee->obj_riwayat_pangkat->last();
        $employee_arr['pangkat_golongan']  = "-";
        if($last_pangkat){
            $employee_arr['pangkat_golongan']  = $last_pangkat->obj_pangkat->name." - ".$last_pangkat->obj_pangkat->kode;
        }
        $last_jabatan = $employee->obj_riwayat_jabatan->last();
        
        $employee_arr['jabatan_text']  = "-";
        if($last_jabatan){
            $employee_arr['jabatan_text']  = $last_jabatan->nama_jabatan;
        }
        $employee_arr['unit_organisasi_text']  = "-";
        if($employee->obj_satker){
            $employee_arr['unit_organisasi_text']  = $employee->obj_satker->name;
        }
        $employee_arr['pendidikan_terakhir_text']  = "-";
        
        $last_pendidikan = $employee->obj_riwayat_pendidikan->last();
        if($last_pendidikan){
            $employee_arr['pendidikan_terakhir_text']  = $last_pendidikan->jurusan;
        }
        return response()->json(["employee" => $employee_arr, "saldo_cuti" => $saldo_cuti]);
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
