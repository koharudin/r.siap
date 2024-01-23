<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Hukuman;
use App\Models\AlasanHukuman;
use App\Models\PejabatPenetap;
use App\Models\RiwayatHukuman;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatHukumanController  extends ProfileController
{
    public $activeTab = 'riwayat_hukuman';
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Hukuman';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatHukuman());
        $grid->model()->orderBy('tmt_sk', 'asc');

        $grid->column('tingkat_hukuman', __('TINGKAT'))->display(function($o) {
            if($o == "R") {
                return "Hukdis Ringan";
            } else if($o == "S") {
                return "Hukdis Sedang";
            } else if($o == "B") {
                return "Hukdis Berat";
            } else if($o == "K") {
                return "Hukuman Kode Etik";
            }
            return "-";
        });
        $grid->column('nomor_pp', __('PERATURAN'))->display(function($o) {
            if($o == "07") {
                return "PP 94 TAHUN 2021";
            } else if($o == "03") {
                return "PP 53 TAHUN 2010";
            }
            return "-";
        });
        $grid->column('obj_hukuman.hukuman', __('JENIS'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tmt_sk', __('TMT HUKUMAN'))->display(function($o) {
            if($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('masa_tahun', __('MASA TAHUN'));
        $grid->column('masa_bulan', __('MASA BULAN'));

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
        $show = new Show(RiwayatHukuman::findOrFail($id));

        $show->field('tingkat_hukuman', 'TINGKAT HUKUMAN')->as(function($value) {
            if($value == "R") {
                return "Hukdis Ringan";
            } else if($value == "S") {
                return "Hukdis Sedang";
            } else if($value == "B") {
                return "Hukdis Berat";
            } else if($value == "K") {
                return "Hukuman Kode Etik";
            }
            return "-";
        });
        $show->field('obj_hukuman.hukuman', __('JENIS HUKUMAN'));
        $show->field(('obj_alasan.nama_hukuman'), __(('PELANGGARAN')));
        $show->field('nomor_pp', 'NO PERATURAN')->as(function($value) {
            if($value == "07") {
                return "PP 94 TAHUN 2021";
            } else if($value == "03") {
                return "PP 53 TAHUN 2010";
            }
            return "-";
        });
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', 'TGL SK')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('tmt_sk', 'TMT HUKUMAN')->as(function($value) {
            return (!empty($value)) ? $value->format('d-m-Y') : "-";
        });
        $show->field('tmt_akhir', 'TMT AKHIR')->as(function($value) {
            return (!empty($value)) ? date_create($value)->format('d-m-Y') : "-";
        });
        $show->field('masa_tahun', __('MASA TAHUN'));
        $show->field('masa_bulan', __('MASA BULAN'));
        $show->divider('');
        $show->field('pejabat_penetap_nama', __('PEJABAT PENETAP NAMA'));
        $show->field('pejabat_penetap_jabatan', __('PEJABAT PENETAP JABATAN'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatHukuman());

        $form->hidden('employee_id', __('Employee id'));
        $form->hidden('flag_integrasi', __('Status Integrasi'));
        $form->select('tingkat_hukuman', 'TINGKAT HUKUMAN')->options(Hukuman::selectRaw("id_tingkat, CASE 
            WHEN id_tingkat = 'R' THEN 'Hukdis Ringan'
            WHEN id_tingkat = 'S' THEN 'Hukdis Sedang'
            WHEN id_tingkat = 'B' THEN 'Hukdis Berat'
            WHEN id_tingkat = 'K' THEN 'Hukuman Kode Etik'
            END as mapped_tingkat")->whereNotNull('id_tingkat')->groupBy('id_tingkat')->orderByRaw("CASE 
            WHEN id_tingkat = 'R' THEN 1
            WHEN id_tingkat = 'S' THEN 2
            WHEN id_tingkat = 'B' THEN 3
            WHEN id_tingkat = 'K' THEN 4
            END")->pluck('mapped_tingkat', 'id_tingkat'));
        $form->select('hukuman_id', 'JENIS HUKUMAN')->options(Hukuman::whereNotNull('siasn_id')->orderBy('id', 'asc')->pluck('hukuman', 'simpeg_id'))->required();
        $form->select('alasan_hukuman', 'PELANGGARAN')->options(AlasanHukuman::all()->pluck('nama_hukuman', 'id_hukuman'))->required();
        $options = [
            '07' => 'PP 94 TAHUN 2021',
            '03' => 'PP 53 TAHUN 2010',
        ];
        $form->select('nomor_pp', 'NO PERATURAN')->options($options);
        $form->text('no_sk', __('NO SK'))->required();
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'))->required();
        $form->date('tmt_sk', __('TMT HUKUMAN'))->default(date('Y-m-d'));
        $form->date('tmt_akhir', __('TMT AKHIR'))->default(date('Y-m-d'));
        $form->number('masa_tahun', __('MASA TAHUN'));
        $form->number('masa_bulan', __('MASA BULAN'));

        $form->divider("Pejabat Penetap");
        $form->text('pejabat_penetap_nama', __('PENETAP NAMA'));
        $form->text('pejabat_penetap_jabatan', __('PENETAP JABATAN'));

        /* $form->saving(function(Form $form) {
            if($form->pejabat_penetap_id) {
                $r = PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
        });
        $form->saving(function(Form $form) {
            if($form->pejabat_penetap_akhir_id) {
                $r = PejabatPenetap::where('id', $form->pejabat_penetap_akhir_id)->get()->first();
                if($r) {
                    $form->pejabat_penetap_akhir_jabatan = $r->jabatan;
                    $form->pejabat_penetap_akhir_nip = $r->nip;
                    $form->pejabat_penetap_akhir_nama = $r->nama;
                }
            }
        }); */
        
        $form->saving(function(Form $form) {
            $form->flag_integrasi = 1;
        });
        return $form;
    }
}
