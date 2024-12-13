<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridJabatan;
use App\Admin\Selectable\GridJabatanStruktural;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\Eselon;
use App\Models\Jabatan;
use App\Models\RiwayatJabatan;
use App\Models\StatusJabatan;
use App\Models\TipeJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Controllers\SiasnController;
use DateTime;

class RiwayatJabatanController extends ProfileController
{
    public $activeTab = 'riwayat_jabatan';
    public $klasifikasi_id = 6;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Jabatan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatJabatan());
        $grid->model()->orderBy('tmt_jabatan', 'desc');

        $grid->column('nama_jabatan', __('JABATAN'));
        $grid->column('unit_text', __('UNIT KERJA'));
        $grid->column('no_sk', __('NOMOR SK'));
        $grid->column('tmt_jabatan', __('TMT JABATAN'))->display(function ($o) {
            if($o) {
                return $this->tmt_jabatan->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_sk', __('TANGGAL SK'))->display(function ($o) {
            if($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_status_jabatan.name', __('STATUS JABATAN'));
	    $grid->column('status_riwayat', __('STATUS RIWAYAT'))->display(function ($o) {
            if($o == 1) {
                return "Aktif";
            } else {
                return "Inaktif";
            }
        });
        $grid->column('id_siasn', __('INTG.<br>MYASN'))->display(function($o) {
            if(!empty($this->id_siasn)) {
                $label = 'success';
                $status = '<i class="fa fa-check"></i>';
            } else {
                $label = 'danger';
                $status = '<i class="fa fa-times"></i>';
            }
            return "<span class='label label-$label'>".$status."</span>";
        });

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $riwayatJabatan = RiwayatJabatan::findOrFail($id);
        $show = new Show($riwayatJabatan);
        $apiData = SiasnController::get_jabatan($riwayatJabatan->id_siasn);
        $apiData = (array) $apiData;
        // var_dump(session('token_sso'));
        // dd($apiData);
        // die();

        $show->field('no_sk', 'NOMOR SK')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data1', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['nomorSk'])) ? $apiData['nomorSk'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tgl_sk', 'TANGGAL SK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data2', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tanggalSk'])) ? $apiData['tanggalSk'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('tmt_jabatan', 'TMT JABATAN')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });          
        $show->field('api_data3', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tmtJabatan'])) ? $apiData['tmtJabatan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('obj_tipe_jabatan.name', 'TIPE JABATAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data4', ' ')->unescape()->as(function() use($apiData) {
            if(empty($apiData['jenisJabatan'])) {
                $value = "-";
            } else if($apiData['jenisJabatan'] == 1) {
                $value = "Jabatan Struktural";
            } else if($apiData['jenisJabatan'] == 2) {
                $value = "Jabatan Fungsional";
            } else if($apiData['jenisJabatan'] == 3) {
                $value = "Jabatan Pelaksana";
            }
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('obj_eselon.name', 'ESELON')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data5', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['eselon'])) ? $apiData['eselon'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('nama_jabatan', 'NAMA JABATAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data6', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['namaJabatan'])) ? $apiData['namaJabatan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('unit_text', 'NAMA UNIT KERJA')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data7', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['namaUnor'])) ? $apiData['namaUnor'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('no_pelantikan', 'NOMOR PELANTIKAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->divider();
        
        $show->field('tgl_pelantikan', 'TANGGAL PELANTIKAN')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('api_data8', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tmtPelantikan'])) ? $apiData['tmtPelantikan'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('grade', 'KELAS JABATAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->divider();

        $show->field('bln_dibayar', 'BULAN DIBAYAR')->as(function($value) {
            return (!empty($value)) ? (new DateTime($value))->format('d-m-Y') : "-";
        });
        $show->divider();

        $show->field('obj_status_jabatan.name', 'STATUS JABATAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data9', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['jenisPenugasanId'])) ? $apiData['jenisPenugasanId'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('status_riwayat', 'STATUS RIWAYAT')->as(function($value) {
            if($value == 1) {
                $value = "Aktif";
            } else {
                $value = "Inaktif";
            }
            return $value;
        });
        $show->divider();

        $show->field('pejabat_penetap_nama', 'PENETAP NAMA')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('pejabat_penetap_jabatan', 'PENETAP JABATAN')->as(function($value) {
            return $value ?? '-';
        });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatJabatan());

        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('flag_integrasi');
        $form->hidden('id');
        $form->text('no_sk', __('NOMOR SK'))->required();
        $form->date('tgl_sk', __('TANGGAL SK'))->required();
        $form->date('tmt_jabatan', __('TMT JABATAN'))->required();
        $form->hidden('jabatan_id');
        $form->select('tipe_jabatan_id', __('TIPE JABATAN'))->required()->options(TipeJabatan::all()->pluck('name', 'id'))->when('in', [1, 6], function (Form $form) {
            $form->select('eselon', __('ESELON'))->options(Eselon::all()->pluck('name', 'id'));
            $form->belongsTo('jabatan_id_struktural', GridJabatanStruktural::class, 'JABATAN STRUKTURAL');
        })->when('in', [2, 3, 4, 5], function (Form $form) {
            $form->belongsTo('jabatan_id_fungsional', GridJabatan::class, 'JABATAN FUNGSIONAL/UMUM');
        });
        $form->display('nama_jabatan', __('NAMA JABATAN'));
        $form->belongsTo('unit_id', GridUnitKerja::class, __('UNIT KERJA'))->required();
        $form->display('unit_text', __('NAMA UNIT KERJA'));
        $form->text('no_pelantikan', __('NOMOR PELANTIKAN'));
        $form->date('tgl_pelantikan', __('TANGGAL PELANTIKAN'));
        $form->select('grade', __('KELAS JABATAN'))->options(array_combine(range(1, 17), range(1, 17)))->required();
        $form->date('bln_dibayar', __('BULAN DIBAYAR'));
        $form->select('status_jabatan_id', __('STATUS JABATAN'))->options(StatusJabatan::whereNotNull('id_status_jabatan_siasn')->orderBy('id', 'asc')->pluck('name', 'id'))->required();
        $form->select('status_riwayat', __('STATUS RIWAYAT'))->options(['1' => 'Aktif', '0' => 'Inaktif'])->default('1')->required();
        $form->divider("Pejabat Penetap");
        $form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));
        $form->divider();

        $form->submitted(function (Form $form) {
            $form->ignore('jabatan_id_fungsional');
            $form->ignore('jabatan_id_struktural');
        });
        $_this = $this;
        $form->saving(function (Form $form) use ($_this) {
            $jabatan_id_fungsional = request()->input('jabatan_id_fungsional');
            $jabatan_id_struktural = request()->input('jabatan_id_struktural');
            if(in_array($form->tipe_jabatan_id, [1, 6])) {
                if($jabatan_id_struktural) {
                    $form->jabatan_id = $jabatan_id_struktural;
                    $form->nama_jabatan = UnitKerja::find($form->jabatan_id)->pejabat_jabatan;
                } else {
                    $form->jabatan_id = null;
                }
            } else {
                if($jabatan_id_fungsional) {
                    $form->jabatan_id = $jabatan_id_fungsional;
                    $form->nama_jabatan = Jabatan::find($form->jabatan_id)->name;
                } else {
                    $form->jabatan_id = null;
                }
            }
            if($form->unit_id) {
                $unit_kerja = UnitKerja::where('id', $form->unit_id)->get()->first();
                if($unit_kerja) {
                    $form->unit_text = $unit_kerja->name;
                }
            }
            if($form->status_riwayat == 1) {
                $currentId = $form->id;
                RiwayatJabatan::where('status_riwayat', 1)->where('employee_id', request()->route('profile_id'))->where('id', '!=', $currentId)->update(['status_riwayat' => 0]);
            }
            $form->flag_integrasi = 1;
        });

        return $form;
    }
}
