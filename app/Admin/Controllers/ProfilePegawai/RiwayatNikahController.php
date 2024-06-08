<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\JenisPekerjaan;
use App\Models\RiwayatNikah;
use App\Models\StatusMenikah;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RiwayatNikahController extends ProfileController
{
    public $activeTab = 'riwayat_nikah';
    public $klasifikasi_id = 27;
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Riwayat Nikah';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new RiwayatNikah());
        $grid->model()->orderBy('tgl_kawin','desc');
        $grid->column('name', __('NAMA SUAMI/ISTRI'));
        $grid->column('obj_status_menikah.name', __('STATUS PERNIKAHAN'));
        
        $grid->column('urutan_pasangan', __('SUAMI/ISTRI KE'));
        $grid->column('status_tunjangan', __('SEBAGAI AHLI WARIS'))->display(function ($o) {
            if($o==1) return "<span class='label label-info'>Ya</span>";
            else return "-";
        });
        $grid->column('tgl_kawin', __('TGL NIKAH'))->display(function ($o) {
            if ($o) {
                return $this->tgl_kawin->format('d-m-Y');
            }
            return "-";
        });
        $grid->column('tgl_sk_cerai', __('TGL SK CERAI'))->display(function ($o) {
            if ($o) {
                return $this->tgl_sk_cerai->format('d-m-Y');
            }
            return "-";
        });

        $grid->column('obj_jenis_pekerjaan.name', __('JENIS PEKERJAAN'));

        $grid->column('pekerjaan', __('PEKERJAAN'));

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
        $show = new Show(RiwayatNikah::findOrFail($id));
        $show->field('obj_jenis_pekerjaan.name', __('JENIS PEKERJAAN'));
        $show->field('name', __('NAMA SUAMI/ISTRI'));
        $show->field('birth_place', __('TEMPAT LAHIR'));
        $show->field('birth_date', __('TANGGAL LAHIR'));
        
       
        $show->field('nip', __('NIP'));
        $show->field('status_tunjangan', __('SEBAGAI AHLI WARIS'))->as(function ($o) {
            if($o==1)return "Ya";
        });
        $show->field('sdh_dibayar', __('SUDAH DIBAYAR'))->as(function ($o) {
            if($o==1)return "Ya";
        });
        
        $show->field('tempat_pekerjaan', __('TEMPAT PEKERJAAN'));
        $show->field('pekerjaan', __('PEKERJAAN'));
        $show->field('bulan_dibayar', __('BULAN DIBAYAR'));
        
        $show->field('obj_status_menikah.name', __('STATUS PERNIKAHAN'));
        $show->divider('KETERANGAN PERNIKAHAN');
        $show->field('urutan_nikah', __('NIKAH KE'));
        $show->field('tgl_kawin', __('TGL NIKAH'));
        $show->field('urutan_pasangan', __('SUAMI/ISTRI KE'));
        
        $show->field('buku_nikah', __('NO BUKU NIKAH'));
        $show->field('no_karis', __('NO KARIS'));

        $show->divider('KETERANGAN CERAI');
        $show->field('no_sk_cerai', __('NO SK CERAI'));
        $show->field('tmt_sk_cerai', __('TMT SK CERAI'));
        $show->field('tgl_sk_cerai', __('TGL SK CERAI'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new RiwayatNikah());

        $form->select('jenis_pekerjaan', __('JENIS PEKERJAAN'))->options(JenisPekerjaan::all()->pluck('name','id'));
        $form->text('nip', __('NIP'));

        $form->text('name', __('NAMA SUAMI/ISTRI'));
        $form->text('birth_place', __('TEMPAT LAHIR'));
        $form->date('birth_date', __('TANGGAL LAHIR'))->default(date('Y-m-d'));
        
        $form->select('status', __('STATUS PERNIKAHAN'))->options(StatusMenikah::all()->pluck('name','id'));
        $form->text('pekerjaan', __('PEKERJAAN'));
        $form->text('tempat_pekerjaan', __('TEMPAT PEKERJAAN'));
        $form->select('status_tunjangan', __('SEBAGAI AHLI WARIS'))->options(['1' => 'Ya',  '0' => 'Tidak']);
        $form->select('sdh_dibayar', __('SUDAH DIBAYAR'))->options(['1' => 'Ya',  '0' => 'Tidak']);
        $form->date('bulan_dibayar', __('BULAN DIBAYAR'))->default(date('Y-m-d'));    
        
        

        $form->divider('KETERANGAN NIKAH');
        $opts = [];
        for($i=1;$i<=20;$i++){
            $opts[]=$i;
        }
        $form->hidden('employee_id', __('Employee id'));
        $form->select('urutan_nikah', __('NIKAH KE'))->options($opts);
        $form->date('tgl_kawin', __('TGL NIKAH'))->default(date('Y-m-d'));
        $form->text('urutan_pasangan', __('SUAMI/ISTRI KE'));
        $form->text('buku_nikah', __('NO BUKU NIKAH'));
        $form->text('no_karis', __('NO KARIS'));
        
        $form->divider('KETERANGAN CERAI');
        $form->text('no_sk_cerai', __('NO SK CERAI'));
        $form->date('tmt_sk_cerai', __('TMT SK CERAI'));
        $form->date('tgl_sk_cerai', __('TGL SK CERAI'));
        

        return $form;
    }
}
