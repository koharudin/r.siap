<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Pangkat;
use App\Models\RiwayatAngkaKredit;
use Encore\Admin\Form;

class FormSKCPNS extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'SK CPNS';

    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->select('pangkat_id', 'PANGKAT (GOL RUANG)')->options(Pangkat::all()->pluck('name', 'id'));
        $form->text('no_sk', 'NO SK')->required(true);
        $form->date('tgl_sk', 'TANGGAL SK')->required(true);
        $form->date('tmt_cpns', 'TMT CPNS')->required(true);

        $form->fieldset('PEJABAT YANG MENETAPKAN SK CPNS', function (Form $form) {
            $form->belongsTo('pejabat_penetap_id', GridPejabatPenetap::class, 'PEJABAT PENETAP');
            $form->text('pejabat_penetap_jabatan', 'JABATAN');
            $form->text('pejabat_penetap_nip', 'NIP');
            $form->text('pejabat_penetap_nama', 'NAMA');
        });
        $form->text('masa_kerja_tahun', 'MASA KERJA (TAHUN)');
        $form->text('masa_kerja_bulan', 'MASA KERJA (BULAN)');
        $form->date('tgl_tugas', 'TANGGAL TUGAS');
        $form->fieldset('PENYESUAIAN MASA KERJA', function (Form $form) {
            $form->text('no_sk_penyesuaian_mk', 'NO SK');
            $form->date('tgl_sk_penyesuaian_mk', 'TANGGAL SK');
            $form->date('tmt_sk_penyesuaian_mk', 'TMT SK');
            $form->text('pejabat_penetap_sk_penyesuaian_mk', 'NO SK');
            $form->text('tambahan_tahun', 'TAMBAHAN MASA KERJA (TAHUN)');
            $form->text('tambahan_bulan', 'TAMBAHAN MASA KERJA (BULAN)');
        });
        $form->divider();
        $form->text('total_tahun', 'MASA KERJA AKUMULASI (TAHUN)');
        $form->text('total_bulan', 'MASA KERJA AKUMULASI (BULAN)');
    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
    public function onRefCreateForm($ref_id)
    {
        $record = RiwayatAngkaKredit::findOrFail($ref_id);
        $data = $record->toArray();
        $old_data = $record->toArray();
        request()->session()->flash('old_data', $old_data);
        return $this->edit($data);
    }
}
