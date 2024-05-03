<?php

namespace App\Admin\Controllers;
use Illuminate\Http\Request;
use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\PenempatanPegawai;
use App\Models\RiwayatJabatan;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class ExistingPegawaiController extends Controller
{
    public $title  = 'Daftar Pegawai';
    public function index(Content $content)
    {
        Admin::js('js/v_penghargaan.js');
        return $content
            ->title($this->title)
            ->body(view("v_existing_pegawai"));
    }
    public function dt()
    {
        $query = RiwayatJabatan::with(['obj_employee', 'obj_unit_kerja', 'obj_jabatan_fungsional']);

        $query->where("unit_id", request()->get('unit_id'));
        $query->where("nama_jabatan", request()->get('jabatan'));
        $query->where('status_riwayat', '1');
        
        $query->orderBy('nama_jabatan','asc');
        return  DataTables::eloquent($query)
            ->only(['nip','nama_pegawai','nama_unit','nama_jabatan', 'jabatan_id'])
            ->addIndexColumn()
            ->addColumn('nip', function($row){
                return $row->obj_employee->nip_baru;
            })
            ->addColumn('nama_pegawai', function($row){
                return $row->obj_employee->first_name;
            })
            ->addColumn('nama_unit', function($row){
                return $row->obj_unit_kerja->name;
            })
            ->addColumn('nama_jabatan', function($row){
                return $row->nama_jabatan;
            })
            ->make(true);
    }

}
