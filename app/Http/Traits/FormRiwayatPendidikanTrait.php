<?php

namespace App\Http\Traits;

use App\Admin\Selectable\GridPendidikan;
use App\Models\Pendidikan;
use App\Models\Student;
use Encore\Admin\Widgets\Form;

trait FormRiwayatPendidikanTrait
{
    public function attachForm(Form $form)
    {
        $form->hidden('employee_id', __('Employee id'));
        $form->belongsTo('pendidikan_id', GridPendidikan::class, 'PENDIDIKAN');
        $form->text('jurusan', __('JURUSAN'));
        $form->text('nama_sekolah', __('NAMA SEKOLAH'));
        $form->text('tempat_sekolah', __('TEMPAT SEKOLAH'));
        $form->text('no_sttb', __('NO STTB'));
        $form->date('tgl_sttb', __('TGL STTB'))->default(date('Y-m-d'));
        $form->text('tahun', __('TAHUN'));
        $form->text('akreditasi', __('AKREDITASI'));
        $form->text('ipk', __('IPK'));
        $form->text('kepala_sekolah', __('KEPALA SEKOLAH'));

        $form->saving(function (Form $form) {
            if ($form->pendidikan_id) {
                $r =  Pendidikan::where('id', $form->pendidikan_id)->get()->first();
                if ($r) {
                    $form->jurusan = $r->name;
                }
            }
        });
    }
}
