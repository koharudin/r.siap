<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\CutiBesar;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class CutiBesarController extends Controller
{
    public $title = 'Riwayat Cuti Besar';
    public function index(Content $content) {
        return $content
            ->title($this->title)
            ->body($this->grid());
    }
    public function grid() {
        $grid = new Grid(new CutiBesar());
        $grid->model()->join('tbl_detail_jenis_cuti', 'tbl_cuti.id_detail_jenis_cuti', '=', 'tbl_detail_jenis_cuti.id_detail_jenis_cuti');
        $grid->model()->join('tpegawai', 'tbl_cuti.no_pekerja', '=', 'tpegawai.nomor_pekerja');
        $grid->model()->join('tjabatan', 'tpegawai.kode_jabatan', '=', 'tjabatan.kode_jabatan');
        $grid->model()->join('tunitkerja', 'tpegawai.kode_unit_kerja', '=', 'tunitkerja.kode_unit_kerja');
        $grid->model()->where('tbl_cuti.id_detail_jenis_cuti', 11);
        $grid->model()->orderBy('tgl_selesai', 'desc');
        $grid->paginate(15);
        $grid->disableActions();
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->disableExport();
        $grid->disableColumnSelector();
        
        $grid->rows(function (Grid\Row $row) {
            $row->column('number', $row->number + 1);
        });
        $grid->column('number', __('NO'));
        $grid->column('status', __('STATUS'))->display(function($o) {
            if($this->tgl_selesai->year < now()->year or ($this->tgl_selesai->year = now()->year and $this->tgl_selesai->month < now()->month)) {
                $label = 'danger';
                $status = 'Sudah';
            } else if($this->tgl_selesai->year == now()->year and $this->tgl_selesai->month == now()->month) {
                $label = 'warning';
                $status = 'Sedang';
            } else if($this->tgl_selesai->year > now()->year or ($this->tgl_selesai->year = now()->year and $this->tgl_selesai->month > now()->month)) {
                $label = 'success';
                $status = 'Belum';
            }
            return "<span class='label label-$label'>".$status."</span>";
        });
        $grid->column('tgl_mulai', __('TGL MULAI'))->display(function($o) {
            return $this->tgl_mulai->format('d-m-Y');
        })->sortable();
        $grid->column('tgl_selesai', __('TGL SELESAI'))->display(function($o) {
            return $this->tgl_selesai->format('d-m-Y');
        })->sortable();
        $grid->column('nama_pekerja', __('PEGAWAI'))->display(function ($o) {
            return $this->nama_pekerja."<br>".$this->nipp;
        })->sortable();
        $grid->column('nama_jabatan', __('JABATAN / UNIT KERJA'))->display(function ($o) {
            return $this->nama_jabatan." /<br>".$this->nama_unit_kerja;
        });
        $grid->column('deskripsi_detail_jenis_cuti', __('JENIS CUTI'));
        $grid->column('lama_cuti', __('LAMA CUTI'))->display(function ($o) {
            return $this->lama_cuti." Hari";
        });

        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1/3, function ($filter) {
                $filter->where(function ($query) {
                    $query->where('tgl_selesai', '>=', $this->input);
                }, 'Tanggal')->date();
                
                $filter->where(function ($query) {
                    $query->orWhere('tgl_mulai', '<=', $this->input);
                }, 's/d')->date();
            });
            $filter->column(1/2, function ($filter) {
                $filter->where(function ($query) {
                    $query->where('nama_pekerja', 'like', "%".$this->input.'%')->orWhere('nipp', 'like', "%".$this->input.'%');
                }, 'Nama / NIP');
                $filter->where(function ($query) {
                    switch($this->input) {
                        case 1:
                            $query->whereRaw('year(tbl_cuti.tgl_selesai) > year(CURRENT_DATE) or (year(tbl_cuti.tgl_selesai) = year(CURRENT_DATE) and month(tbl_cuti.tgl_selesai) > month(CURRENT_DATE))');
                            break;
                        case 2:
                            $query->whereRaw('year(tbl_cuti.tgl_selesai) = year(CURRENT_DATE) and month(tbl_cuti.tgl_selesai) = month(CURRENT_DATE)');
                            break;
                        case 3:
                            $query->whereRaw('year(tbl_cuti.tgl_selesai) < year(CURRENT_DATE) or (year(tbl_cuti.tgl_selesai) = year(CURRENT_DATE) and month(tbl_cuti.tgl_selesai) < month(CURRENT_DATE))');
                            break;
                    }
                }, 'Status')->select([1 => 'Belum', 2 => 'Sedang', 3 => 'Sudah']);
            });
        });

        if(empty($_GET) or (count($_GET) == 1 and isset($_GET['_pjax']))) {
            $grid->model()->where('tgl_selesai', '>=', date('Y').'-01-01');
        }

        return $grid;
    }
}
