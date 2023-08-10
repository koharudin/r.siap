<?php

namespace App\Admin\Forms\Requests;

use App\Admin\Selectable\GridPejabatPenetap;
use App\Models\Pangkat;
use App\Models\PejabatPenetap;
use App\Models\RiwayatAngkaKredit;
use App\Models\RiwayatPangkat;
use Encore\Admin\Form;

class FormSKPensiun extends FF
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = 'SK PENSIUN';

    /**
     * Build a form here.
     */
    public function buildForm()
    {
        $form = $this;
        $form->hidden('employee_id', 'ID');
        // Add an input box of type text
        $form->text('no_bkn', 'NO BKN');
        $form->date('tgl_bkn', 'TGL BKN');
        $form->text('no_sk', 'NO SK PENSIUN')->required(true);
        $form->date('tgl_pensiun', 'TANGGAL PENSIUN')->required(true);
        $form->date('tmt_pensiun', 'TMT PENSIUN')->required(true);
        $form->select('pangkat_id', 'PANGKAT (GOL RUANG)')->options(Pangkat::all()->pluck('name','id'));
        $form->text('masa_kerja_tahun', 'MASA KERJA TAHUN');
        $form->text('masa_kerja_bulan', 'MASA KERJA BULAN');
        $form->text('unit_kerja', 'UNIT KERJA');

    }
    public function onCreateForm()
    {
        $data = [];
        return parent::edit($data);
    }
}
