<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Selectable\GridPendidikan;
use App\Models\Pendidikan;
use App\Models\RiwayatPendidikan;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class RiwayatPendidikanController extends ProfileController
{
    public $activeTab = 'riwayat_pendidikan';
    public $klasifikasi_id = 11;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Pendidikan';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatPendidikan());
        $grid->model()->orderBy('tahun','asc');
        $grid->column('jurusan', __('JURUSAN'));
        $grid->column('nama_sekolah', __('NAMA SEKOLAH'));
        $grid->column('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $grid->column('tahun', __('TAHUN'));

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
        $show = new Show(RiwayatPendidikan::findOrFail($id));


        $show->field('pendidikan_id', __('PENDIDIKAN'));
        $show->field('jurusan', __('JURUSAN'));
        $show->field('nama_sekolah', __('NAMA SEKOLAH'));
        $show->field('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $show->field('no_sttb', __('NO STTB'));
        $show->field('tgl_sttb', __('TGL STTB'));
        $show->field('tahun', __('TAHUN'));
        $show->field('kepala_sekolah', __('KEPALA SEKOLAH'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatPendidikan());

        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('pendidikan_id',GridPendidikan::class,'PENDIDIKAN');
        $form->text('jurusan', __('JURUSAN'));
        $form->text('nama_sekolah', __('NAMA SEKOLAH'));
        $form->text('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $form->text('no_sttb', __('NO STTB'));
        $form->date('tgl_sttb', __('TGL STTB'))->default(date('Y-m-d'));
        $form->text('tahun', __('TAHUN'));
        $form->text('akreditasi', __('AKREDITASI'));
        $form->text('ipk', __('IPK'));
        $form->text('kepala_sekolah', __('KEPALA SEKOLAH'));
        $_this = $this;
        $form->saving(function (Form $form) use ( $_this) {
            if ($form->pendidikan_id) {
                $r =  Pendidikan::where('id', $form->pendidikan_id)->get()->first();
                if ($r) {
                    $form->jurusan = $r->name;
                }
            }
        });
        return $form;
    }
}
