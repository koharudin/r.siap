<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class PenghargaanController extends Controller
{
    public $title  = 'Penghargaan';
    public function index(Content $content)
    {
        Admin::js('js/v_penghargaan.js');
        return $content
            ->title($this->title)
            ->body(view("v_penghargaan"));
    }
    public function dt()
    {
        $params = request('extra_search');
        foreach($params as $param){
            if(@$param['name'] =='kriteria'){
                //$param['value']    
            }
            if(@$param['name'] =='jenis'){
                //$param['value']
            }
        } 
        $query = Employee::with(['obj_riwayat_jabatan','obj_satker', 'obj_riwayat_pangkat.obj_pangkat']);
        $query->orderBy('first_name','asc');
        return  DataTables::eloquent($query)
            ->only(['no', 'action', 'first_name', 'intro', 'nip_baru', 'jabatan', 'pangkat', 'unit_kerja', 'jenis_penghargaan'])
            ->addIndexColumn()
            ->addColumn('no', function (Employee $user) {
                return 'Hi ' . $user->name . '!';
            })
            ->addColumn('unit_kerja', function (Employee $user) {
                if ($user->obj_satker) {
                    return $user->obj_satker->name;
                }
                return "Belum di tempatkan!";
            })
            ->addColumn('jenis_penghargaan', function (Employee $user) { 
                return "SATYALANCANA KARYA SATYA";
            })
            ->addColumn('jabatan', function (Employee $user) {
                $last = $user->obj_riwayat_jabatan->last();
                return  $last->nama_jabatan;
            })
            ->addColumn('pangkat', function (Employee $user) {
                $last = $user->obj_riwayat_pangkat->last();
                return  $last->obj_pangkat->name . " - " . $last->obj_pangkat->kode;
            })
            /* ->addColumn('action', function ($row) {
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            */
            ->make(true);
    }
}
