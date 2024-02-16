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

class PenempatanPegawaiController extends Controller
{
    public $title  = 'Penempatan Pegawai ABK';
    public function index(Content $content)
    {
        Admin::js('js/v_penghargaan.js');
        return $content
            ->title($this->title)
            ->body(view("v_penempatan_pegawai"));
    }
    public function dt()
    {
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

        $query->orderBy('nama_unitkerja','asc');
        $query->orderBy('nama_jabatan','asc');
        return  DataTables::eloquent($query)
            ->only(['nama_unitkerja','bulan','tahun','nama_jabatan', 'jabatan_id', 'kebutuhan', 'existing_pegawai','url_existing', 'kelebihan_kekurangan','kelebihan','kekurangan','aksi'])
            ->addIndexColumn()
            ->addColumn('nama_jabatan', function ($row) {
                $nama = $row->jabatan_id.' - '.$row->nama_jabatan;
                return $nama;
            })
            ->addColumn('url_existing', function($row){
               return [$row->existing_pegawai, $row->unit_id, $row->nama_jabatan];
            })
            ->addColumn('kelebihan', function($row){
                if($row->kelebihan_kekurangan < 0){
                    return ($row->kelebihan_kekurangan * -1);
                }
                else{
                    return 0;
                }
            })
            ->addColumn('kekurangan', function($row){
                if($row->kelebihan_kekurangan > 0){
                    return ($row->kelebihan_kekurangan);
                }
                else{
                    return 0;
                }
            })
            ->addColumn('aksi', function ($row) {
               return [$row->kebutuhan, $row->existing_pegawai];
            })
            ->make(true);
    }

    public function sinkrondata()
    {
        $query = PenempatanPegawai::with([]);
        
        $unit_id = request()->input('unitkerja'); 
        if($unit_id != ""){
            $query->where("unit_id", $unit_id);
        }
        $bulan = request()->input('bulan');
        if($bulan != ""){
            $query->where("bulan", $bulan);
        }
        $tahun = request()->input('tahun');
        if($tahun != ""){
            $query->where("tahun", $tahun);
        }
        
        return  DataTables::eloquent($query)
            ->only(['unit_id','jabatan_id','kebutuhan', 'existing_pegawai', 'kelebihan_kekurangan'])
            ->addIndexColumn()
            ->addColumn('existing_pegawai', function ($row) { 
                //Hitung Existing Pegawai Per Jabatan dalam Sebuah Unit Kerja
                $jumlahExistingPegawai = $this->ExistingPegawai($row->unit_id, $row->nama_jabatan);              
                $row->existing_pegawai = $jumlahExistingPegawai;
                $row->save();
            })
            ->addColumn('kelebihan_kekurangan', function ($row) { 
                //Update Kelebihan_Kekurangan
                //Jika hasilnya minus berarti kelebihan pegawai               
                $row->kelebihan_kekurangan = $row->kebutuhan - $row->existing_pegawai;
                $row->save();
            })
            ->make(true);
    }

    public function ExistingPegawai($unit_id, $jabatan_id){

        $query = RiwayatJabatan::with([]);
        $query->where('unit_id', $unit_id);
        $query->where('nama_jabatan', $jabatan_id);
	$query->whereNotIn('tipe_jabatan_id', [1,6]);
        $query->where('status_riwayat', '1');

        return $query->count();
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

        $result = array('totalkebutuhan'=>$query->sum('kebutuhan'), 'totalexisting'=>$query->sum('existing_pegawai'), 'totalkelebihan'=> (($query->where("kelebihan_kekurangan","<", 0)->sum('kelebihan_kekurangan')) * -1), 'totalkekurangan' =>$query2->where("kelebihan_kekurangan",">", 0)->sum('kelebihan_kekurangan'));
        echo json_encode($result);
    }

}
