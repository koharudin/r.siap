<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridUnitKerja;
use App\Models\RiwayatMutasi;
use App\Models\RiwayatJabatan;
use App\Models\UnitKerja;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Carbon\Carbon;
use App\Admin\Controllers\SiasnController;

class RiwayatMutasiController extends ProfileController
{
    public $activeTab = 'riwayat_mutasi';
    public $klasifikasi_id = 7;
    public $use_document = true;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Mutasi';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatMutasi());
        $grid->model()->orderBy('tmt_sk', 'desc');

        $grid->column('satker_baru', __('UNIT KERJA BARU'));
        $grid->column('satker_lama', __('UNIT KERJA LAMA'));
        $grid->column('no_sk', __('NOMOR SK'));
        $grid->column('tmt_sk', __('TMT MUTASI'))->display(function ($o) {
            if($o) {
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_sk', __('TANGGAL SK'))->display(function ($o) {
            if($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('obj_riwayat_jabatan.nama_jabatan', __('RIWAYAT JABATAN'));
        $grid->column('id', __('LAMA KERJA DI UNIT'))->display(function ($o) {
            $riwayatMutasi = RiwayatMutasi::where('employee_id', $this->employee_id)
                ->orderBy('tmt_sk')
                ->get();

            $nextTmtSk = Carbon::now();
            $tmtSk = $riwayatMutasi->min('tmt_sk');

            foreach($riwayatMutasi as $index => $mutasi) {
                if($mutasi->id == $o) {
                    $tmtSk = $mutasi->tmt_sk;
                    if($index < count($riwayatMutasi) - 1) {
                        $nextTmtSk = $riwayatMutasi[$index + 1]->tmt_sk;
                    }
                }
            }

            if($riwayatMutasi->min('tmt_sk') <= $riwayatMutasi->last()->tmt_sk) {
                $lengthOfService = $tmtSk->diff($nextTmtSk);

                return "$lengthOfService->y Tahun $lengthOfService->m Bulan $lengthOfService->d Hari";
            } else {
                return "Invalid Date Range";
            }
        });
        // $grid->column('lama_kerja_diunit', __('TOTAL LAMA KERJA'))->display(function () {
        //     $riwayatMutasi = RiwayatMutasi::where('employee_id', $this->employee_id)
        //         ->orderBy('tmt_sk')
        //         ->get();

        //     $currentDate = Carbon::now();
        //     $firstTmtSk = $riwayatMutasi->min('tmt_sk');

        //     if($firstTmtSk <= $riwayatMutasi->last()->tmt_sk) {
        //         $lengthOfService = $firstTmtSk->diff($currentDate);

        //         return "$lengthOfService->y Tahun $lengthOfService->m Bulan $lengthOfService->d Hari";
        //     } else {
        //         return "Invalid Date Range";
        //     }
        // });
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
        if(!Admin::user()->can('create-riwayat_pangkat')) {
            $grid->disableCreateButton();
        }
        $grid->actions(function ($actions) {
            if(!Admin::user()->can('delete-riwayat_pangkat')) {
                $actions->disableDelete();
            }
            if(!Admin::user()->can('edit-riwayat_pangkat')) {
                $actions->disableEdit();
            }
        });
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                if(!Admin::user()->can('delete-riwayat_pangkat')) {
                    $batch->disableDelete();
                }
            });
        });
        $grid->disableRowSelector();
        
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
        $riwayatMutasi = RiwayatMutasi::findOrFail($id);
        $show = new Show($riwayatMutasi);
        $apiData = SiasnController::get_jabatan($riwayatMutasi->id_siasn);
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

        $show->field('tmt_sk', 'TMT MUTASI')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });          
        $show->field('api_data3', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['tmtJabatan'])) ? $apiData['tmtMutasi'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('obj_riwayat_jabatan.nama_jabatan', 'RIWAYAT JABATAN')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data5', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['jabatanMutasi'])) ? $apiData['jabatanMutasi'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('satker_baru', 'UNIT KERJA BARU')->as(function($value) {
            return $value ?? '-';
        });
        $show->field('api_data4', ' ')->unescape()->as(function() use($apiData) {
            $value = (!empty($apiData['namaUnor'])) ? $apiData['namaUnor'] : "-";
            return "<span style='color: blue;'>".$value."</span>&nbsp;<span style='font-size: 11px;'>(dari MyASN)</span>";
        });
        $show->divider();

        $show->field('satker_lama', 'UNIT KERJA LAMA')->as(function($value) {
            return $value ?? '-';
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
        $form = new Form(new RiwayatMutasi());

        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('flag_integrasi');
        $form->text('no_sk', __('NOMOR SK'))->required();
        $form->date('tgl_sk', __('TANGGAL SK'))->required();
        $form->date('tmt_sk', __('TMT MUTASI'))->required();
        $form->belongsTo('satker_id_baru', GridUnitKerja::class, 'UNIT KERJA BARU')->required();
        $form->display('satker_baru', __('NAMA UNIT BARU'));
        $form->belongsTo('satker_id_lama', GridUnitKerja::class, 'UNIT KERJA LAMA');
        $form->display('satker_lama', __('NAMA UNIT LAMA'));
        $form->select('riwayat_jabatan_id', __('RIWAYAT JABATAN'))->options(RiwayatJabatan::selectRaw("concat(nama_jabatan, ' (', tmt_jabatan, ')') as nama, id")->where('employee_id', request()->route('profile_id'))->orderBy('tmt_jabatan', 'desc')->pluck('nama', 'id'))->required();
        $form->divider('Pejabat Penetap');
        $form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));
        
        $form->saving(function (Form $form) {
            if($form->satker_id_lama) {
                $r = UnitKerja::where('id', $form->satker_id_lama)->get()->first();
                if($r) {
                    $form->satker_lama = $r->name;
                }
            }
            if($form->satker_id_baru) {
                $r = UnitKerja::where('id', $form->satker_id_baru)->get()->first();
                if($r) {
                    $form->satker_baru = $r->name;
                }
            }
            $form->flag_integrasi = 1;
        });

        return $form;
    }

    public function edit($profile_id, $id, Content $content)
    {
        Permission::check('edit-riwayat_mutasi');
        return parent::edit($profile_id, $id, $content);
    }
}
