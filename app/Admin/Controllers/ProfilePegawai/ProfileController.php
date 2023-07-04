<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Employee;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Form\Tab;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab as WidgetsTab;
use Illuminate\Routing\Controller;

class ProfileController extends AdminController
{
    public $profile_id;
    public $activeTab = '';
    public function __construct()
    {
        $this->profile_id = request()->route('profile_id');
    }
    public function headerTab()
    {
        $id = $this->profile_id;
        $tab = new WidgetsTab();
        $links = [
                'Data Personal' => "data_personal",
                'Angka Kredit' => "riwayat_angkakredit",
                'Riwayat Pangkat'=>  "riwayat_pangkat",
                'Riwayat Jabatan'=>  "riwayat_jabatan",
                'Riwayat Mutasi'=>  "riwayat_mutasi",
                'Riwayat Sumpah'=>  "riwayat_sumpah",
                'Riwayat Gaji'=>  "riwayat_gaji",
                'Riwayat SK Mutasi PAS'=>  "riwayat_sk_mutasi_pas",
                'SK Pensiun'=>  "riwayat_sk_pensiun",
                'Riwayat Pendidikan'=>  "riwayat_pendidikan",
                'Diklat Struktural'=>  "riwayat_diklat_struktural",
                'Diklat Fungsional'=>  "riwayat_diklat_fungsional",
                'Diklat Teknis'=>  "riwayat_diklat_teknis",
                
                'Kursus'=>  "riwayat_kursus",
                'Seminar'=>  "riwayat_seminar",
                'Nilai DP3'=>  "riwayat_dp3",
                'Uji Kompetensi'=>  "riwayat_uji_kompetensi",
                'Penghargaan'=>  "riwayat_penghargaan",
                'Potensi Diri'=>  "riwayat_potensi_diri",
                'Prestasi Kerja'=>  "riwayat_prestasi_kerja",

                
                'Orang Tua'=>  "riwayat_orangtua",
                'Istri Suami'=>  "riwayat_istrisuami",

                'Organisasi'=>  "riwayat_organisasi",
  
                'Hukuman'=>  "riwayat_hukuman",
                'Diklat Teknis'=>  "riwayat_diklat_teknis",
        ];
        foreach ($links as $k=>$v){
            if($v===$this->activeTab){
                $tab->addLink($k,$v,true);
            }
            else $tab->addLink($k,$v,false);
        }
        return $tab;
    }
    public function header()
    {
        $form = new Form(new Employee());
        $form->setTitle("Data Personal");
        $form->display('first_name', 'Nama Lengkap')->default('qwe@aweq.com');
        $form->image('foto')->disk('minio_foto')->readonly()->value(1);
        $form->display('nip_baru', 'NIP');
        $form->edit($this->profile_id);
        $form->disableSubmit();
        $form->disableReset();
        $form->tools(function (Form\Tools $tools) {

            // Disable `List` btn.
            $tools->disableList();

            // Disable `Delete` btn.
            $tools->disableDelete();

            // Disable `Veiw` btn.
            $tools->disableView();

            // Add a button, the argument can be a string, or an instance of the object that implements the Renderable or Htmlable interface
            //$tools->add('<a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;&nbsp;delete</a>');
        });
        return $form;
    }
    public function index(Content $content)
    {
        $grid = $this->grid();
        $grid->model()->where('employee_id',  $this->profile_id);

        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->header()->render())
            ->body($this->headerTab())
            ->body($grid);
    }
    public function edit($id, Content $content)
    {
        $id = request()->route('id');
        return parent::edit($id, $content);
    }
    public function update($id)
    {
        $id = request()->route('id');
        return $this->form()->update($id);
    }
    public function store()
    {
        return $this->form()->saving(function (Form $form) {
            $form->employee_id = request()->route('profile_id');
        })->store();
    }
    public function show($id, Content $content)
    {
        $id = request()->route('id');
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }
}
