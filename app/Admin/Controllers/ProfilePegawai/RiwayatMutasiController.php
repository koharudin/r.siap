<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Admin\Selectable\GridUnitKerja;
use App\Models\PejabatPenetap;
use App\Models\RiwayatMutasi;
use App\Models\UnitKerja;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Carbon\Carbon;


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
        $grid->column('satker_lama', __('SATKER LAMA'));
        $grid->column('satker_baru', __('SATKER BARU'));
        $grid->column('no_sk', __('NO SK'));
        $grid->column('tgl_sk', __('TGL SK'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tmt_sk', __('TMT SK'))->display(function ($o) {
            if ($o) {
                return $this->tmt_sk->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('lama_kerja_diunit', __('LAMA BEKERJA'))->display(function () {
            // Mendapatkan riwayat mutasi berdasarkan employee_id, diurutkan dari yang terbaru
            $riwayatMutasi = RiwayatMutasi::where('employee_id', $this->employee_id)
                ->orderBy('tmt_sk')
                ->get();

            // Mendapatkan tanggal saat ini
            $currentDate = Carbon::now();

            // Inisialisasi total bulan menjadi 0
            $totalMonths = 0;

            // Mendapatkan TMT_SK unit/satker pertama
            $firstTmtSk = $riwayatMutasi->min('tmt_sk');

            // Loop melalui setiap entri riwayat mutasi
            foreach ($riwayatMutasi as $index => $mutasi) {
                // Ambil tanggal TMT_SK dari entri mutasi
                $tmtSk = $mutasi->tmt_sk;

                // Jika ini bukan entri terakhir, hitung dari tmt_sk ke tmt_sk berikutnya
                if ($index < count($riwayatMutasi) - 1) {
                    $nextTmtSk = $riwayatMutasi[$index + 1]->tmt_sk;
                    $totalMonths += $tmtSk->diffInMonths($nextTmtSk);
                } else {
                    // Jika ini entri terakhir, hitung dari tmt_sk terakhir ke waktu sekarang
                    $totalMonths += $tmtSk->diffInMonths($currentDate);
                }
            }

            // Check apakah firstTmtSk lebih kecil(tanggal terakhir dalam riwayat mutasi)
            if ($firstTmtSk <= $riwayatMutasi->last()->tmt_sk) {
                // Menghitung lama bekerja dari firstTmtSk ke waktu sekarang
                $lengthOfService = $firstTmtSk->addMonths($totalMonths)->diff($currentDate);

                // Konversi total bulan ke tahun, bulan, dan hari
                $years = floor($totalMonths / 12);
                $months = $totalMonths % 12;
                $days = $lengthOfService->days;

                // Mengembalikan hasil format lama bekerja dalam tahun, bulan, dan hari
                return "$years tahun, $months bulan, $days hari";
            } else {
                // Invalid Date Range jika firstTmtSk > tanggal terakhir dalam riwayat mutasi
                return "Invalid Date Range";
            }
        });

        $grid->column('pejabat_penetap_jabatan', __('PEJABAT PENETAP'));
        if (!Admin::user()->can('create-riwayat_pangkat')) {
            $grid->disableCreateButton();
        }
        $grid->actions(function ($actions) {
            if (!Admin::user()->can('delete-riwayat_pangkat')) {
                $actions->disableDelete();
            }
            if (!Admin::user()->can('edit-riwayat_pangkat')) {
                $actions->disableEdit();
            }
        });
        $grid->tools(function ($tools) {
            $tools->batch(function ($batch) {
                if (!Admin::user()->can('delete-riwayat_pangkat')) {
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
        $show = new Show(RiwayatMutasi::findOrFail($id));

        $show->field('satker_lama', __('SATKER LAMA'));
        $show->field('satker_baru', __('SATKER BARU'));
        $show->field('no_sk', __('NO SK'));
        $show->field('tgl_sk', __('TGL SK'));
        $show->field('tmt_sk', __('TMT SK'));
        $show->field('pejabat_penetap_nip', __('PEJABAT PENETAP NIP'));
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
        $form = new Form(new RiwayatMutasi());

        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('satker_id_lama', GridUnitKerja::class, 'SATKER LAMA');
        $form->text('satker_lama', __('SATKER LAMA'));
        $form->belongsTo('satker_id_baru', GridUnitKerja::class, 'SATKER BARU');
        $form->text('satker_baru', __('SATKER BARU'));
        $form->text('no_sk', __('NO SK'));
        $form->date('tgl_sk', __('TGL SK'))->default(date('Y-m-d'));
        $form->date('tmt_sk', __('TMT SK'))->default(date('Y-m-d'));
        $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
        $form->text('pejabat_penetap_jabatan', __('JABATAN'));
        $form->text('pejabat_penetap_nip', __('NIP'));
        $form->text('pejabat_penetap_nama', __('NAMA'));

        $form->saving(function (Form $form) {
            if ($form->pejabat_penetap_id) {
                $r = PejabatPenetap::where('id', $form->pejabat_penetap_id)->get()->first();
                if ($r) {
                    $form->pejabat_penetap_jabatan = $r->jabatan;
                    $form->pejabat_penetap_nip = $r->nip;
                    $form->pejabat_penetap_nama = $r->nama;
                }
            }
            if ($form->satker_id_lama) {
                $r = UnitKerja::where('id', $form->satker_id_lama)->get()->first();
                if ($r) {
                    $form->satker_lama = $r->name;
                }
            }
            if ($form->satker_id_baru) {
                $r = UnitKerja::where('id', $form->satker_id_baru)->get()->first();
                if ($r) {
                    $form->satker_baru = $r->name;
                }
            }
        });

        return $form;
    }

    public function edit($profile_id, $id, Content $content)
    {
        Permission::check('edit-riwayat_mutasi');
        return parent::edit($profile_id, $id, $content);
    }
}