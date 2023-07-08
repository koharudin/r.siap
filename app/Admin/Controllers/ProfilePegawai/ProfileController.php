<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Models\Employee;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Form\Tab;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab as WidgetsTab;
use Illuminate\Routing\Controller;

class ProfileController
{
    public $activeTab = '';

    public function __construct()
    {
    }
    public function headerTab()
    {
        $tab = new WidgetsTab();
        $links = [
            'Data Personal' => "data_personal",
            'Angka Kredit' => "riwayat_angkakredit",
            'Riwayat Pangkat' =>  "riwayat_pangkat",
            'Riwayat Jabatan' =>  "riwayat_jabatan",
            'Riwayat Mutasi' =>  "riwayat_mutasi",
            'Riwayat Sumpah' =>  "riwayat_sumpah",
            'Riwayat Gaji' =>  "riwayat_gaji",
            //'Riwayat SK Mutasi PAS' =>  "riwayat_sk_mutasi_pas",
            'SK Pensiun' =>  "riwayat_sk_pensiun",
            'Riwayat Pendidikan' =>  "riwayat_pendidikan",
            'Diklat Struktural' =>  "riwayat_diklat_struktural",
            'Diklat Fungsional' =>  "riwayat_diklat_fungsional",
            'Diklat Teknis' =>  "riwayat_diklat_teknis",

            'Kursus' =>  "riwayat_kursus",
            'Seminar' =>  "riwayat_seminar",
            'Nilai DP3' =>  "riwayat_dp3",
            'Uji Kompetensi' =>  "riwayat_uji_kompetensi",
            'Penghargaan' =>  "riwayat_penghargaan",
            'Potensi Diri' =>  "riwayat_potensi_diri",
            'Prestasi Kerja' =>  "riwayat_prestasi_kerja",


            'Orang Tua' =>  "riwayat_orangtua",
            'Istri Suami' =>  "riwayat_istrisuami",
            'Anak' =>  "riwayat_anak",

            'Organisasi' =>  "riwayat_organisasi",

            'Hukuman' =>  "riwayat_hukuman",
            'Diklat Teknis' =>  "riwayat_diklat_teknis",
        ];
        foreach ($links as $k => $v) {
            if ($v === $this->activeTab) {
                $tab->addLink($k, $v, true);
            } else $tab->addLink($k, $v, false);
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
        $form->edit($this->getProfileId());
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
    public function index($profile_id, Content $content)
    {
        $grid = $this->grid();
        if (!Admin::user()->can("create-{$this->activeTab}")) {
            $grid->disableCreateButton();
        }
        $_this = $this;
        $grid->actions(function ($actions) use ($_this) {
            if (!Admin::user()->can("delete-{$_this->activeTab}")) {
                $actions->disableDelete();
            }
            if (!Admin::user()->can("edit-{$_this->activeTab}l")) {
                $actions->disableEdit();
            }
        });
        $grid->tools(function ($tools) use ($_this) {
            $tools->batch(function ($batch) use ($_this) {
                if (!Admin::user()->can("delete-{$this->activeTab}")) {
                    $batch->disableDelete();
                }
            });
        });
        $grid->disableRowSelector();
        $grid->model()->where('employee_id',  $this->getProfileId());
        return $this->index2($profile_id, $content)->body($grid);
    }
    public function index2($profile_id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->header()->render())
            ->body($this->headerTab());
    }
    public function store()
    {
        return $this->form()->saving(function (Form $form) {
            $form->employee_id = request()->route('profile_id');
        })->store();
    }
    protected $title = 'Title';
    protected function title()
    {
        return $this->title;
    }
    public function create($profile_id, Content $content)
    {
        Permission::check("create-{$this->activeTab}");
        return $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'))
            ->body($this->form());
    }
    public function show($profile_id, $id, Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }
    public function edit($profile_id, $id, Content $content)
    {
        Permission::check("edit-{$this->activeTab}");
        return $content
            ->title($this->title())
            ->description($this->description['edit'] ?? trans('admin.edit'))
            ->body($this->form()->edit($id));
    }
    public function update($profile_id, $id)
    {
        return $this->form()->update($id);
    }
    public function getProfileId()
    {
        return request()->profile_id;
    }
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }
}
