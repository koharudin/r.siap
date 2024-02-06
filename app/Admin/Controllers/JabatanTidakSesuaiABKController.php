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

class JabatanTidakSesuaiABKController extends Controller
{
    public $title  = 'Jabatan Tidak Ada Di ABK';
    public function index(Content $content)
    {
        Admin::js('js/v_penghargaan.js');
        return $content
            ->title($this->title)
            ->body(view("v_jabatantidaksesuaiabk"));
    }
    public function dt()
    {
        //Get nama_jabatan
        $query = PenempatanPegawai::with([]);
        $params = request()->get('extra_search');

        if (is_array($params)) {
            foreach ($params as $param) {
                if ($param['name'] == 'unitkerja') {
                    $query->where(function ($query) use ($param) {
                        if($param['value'] != null){
                            $unit_id = $param['value'];
                            $query->where("unit_id", $unit_id);
                        }
                    });
                }
                if ($param['name'] == 'bulan') {
                    $query->where(function ($query) use ($param) {
                        if($param['value'] != null){
                            $bulan = $param['value'];
                            $query->where("bulan", $bulan);
                        }
                    });
                }

                if ($param['name'] == 'tahun') {
                    $query->where(function ($query) use ($param) {
                        if($param['value'] != null){
                            $tahun = $param['value'];
                            $query->where("tahun", $tahun);
                        }
                    });
                }
            }
        }

        $query->select('nama_jabatan')->get()->toArray();

        //Get Jabatan yang tidak ada di Master ABK (Tabel Penempatan Pegawai)
        $query2 = RiwayatJabatan::with(['obj_employee', 'obj_unit_kerja', 'obj_jabatan_fungsional'])
                ->select('unit_id','nama_jabatan')
                ->where('status_riwayat', '1')
                ->whereNotNull('unit_id')
                ->whereNotIn('nama_jabatan', $query)
                ->whereNotIn('tipe_jabatan_id', [1,6])
                ->groupBy('unit_id','nama_jabatan');
                ;

        if(is_array($params)){
            foreach($params as $param){
                if($param['name']="unitkerja"){
                    $query2->where(function ($query2) use ($param) {
                        if($param['value'] != null){
                            $unit_id = $param['value'];
                            $query2->where("unit_id", $unit_id);
                        }
                    });
                }
            }
        }    

        $query2->orderBy('unit_id','asc');
        $query2->orderBy('nama_jabatan','asc');
        return  DataTables::eloquent($query2)
            ->only(['unit_id','unit_kerja','nama_jabatan','existing_pegawai', 'url_existing'])
            ->addIndexColumn()
            ->addColumn('unit_kerja', function ($row) {
                $nama = $row->obj_unit_kerja->name;
                return $nama;
            })
            ->addColumn('nama_jabatan', function ($row) {
                $nama = $row->nama_jabatan;
                return $nama;
            })
            ->addColumn('existing_pegawai', function($row){
               return $count = $this->ExistingPegawai($row->unit_id, $row->nama_jabatan);  ;
            })
            ->addColumn('url_existing', function($row){
                return [$row->unit_id, $row->nama_jabatan];
             })
            ->make(true);
    }

    public function getTotal(){
        $query = PenempatanPegawai::with([]);
        $query2 = PenempatanPegawai::with([]);

        $unit_id = request()->input('unitkerja'); 
        if($unit_id != ""){
            $query->where("unit_id", $unit_id);
            $query2->where("unit_id", $unit_id);
        }
        $bulan = request()->input('bulan');
        if($bulan != ""){
            $query->where("bulan", $bulan);
            $query2->where("bulan", $bulan);
        }
        $tahun = request()->input('tahun');
        if($tahun != ""){
            $query->where("tahun", $tahun);
            $query2->where("tahun", $tahun);
        }

        $result = array('totalexisting'=>$query->sum('existing_pegawai'));
        echo json_encode($result);
    }

    public function ExistingPegawai($unit_id, $jabatan_id){

        $query = RiwayatJabatan::with([]);
        $query->where('unit_id', $unit_id);
        $query->where('nama_jabatan', $jabatan_id);
        $query->where('status_riwayat', '1');

        return $query->count();
    }

}
