<?php

namespace App\Admin\Controllers\ProfilePegawai;

use App\Admin\Forms\Config;
use App\Admin\Forms\Settings;
use App\Models\DokumenPegawai;
use App\Models\Employee;
use Encore\Admin\Auth\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Form;
use Encore\Admin\Form\Field;
use Encore\Admin\Form\Tab;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Tab as WidgetsTab;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProfileController
{
    public $activeTab = '';
    public $klasifikasi_id = 0;
    public $use_document = true;

    public function __construct()
    {
    }
    public function headerTab()
    {
        $tab = new WidgetsTab();
        $links = [
            'Data Personal' => "data_personal",
            'Angka Kredit' => "riwayat_angkakredit",
            'SK CPNS' =>  "riwayat_sk_cpns",
            'SK PNS' =>  "riwayat_sk_pns",
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
            'Pengalaman Kerja' =>  "riwayat_pengalaman_kerja",

            'Rekam Medis' =>  "riwayat_rekam_medis",
            'Orang Tua' =>  "riwayat_orangtua",
            'Mertua' =>  "riwayat_mertua",
            'Riwayat Nikah' =>  "riwayat_nikah",
            'Anak' =>  "riwayat_anak",
            'Saudara' =>  "riwayat_saudara",

            'Organisasi' =>  "riwayat_organisasi",
            'Penguasaan Bahasa' =>  "riwayat_penguasaan_bahasa",

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
    public function header1(){
        $form = new Settings();
        $form->setEmployee($this->getEmployee());
        return $form;
    }
    public function header2(){
        $form = new Config();
        $form->setEmployee($this->getEmployee());
        return $form;
    }
    public function header()
    {
        $form = new Form(new Employee());
        $form->setTitle("Data Personal");
        $form->display('first_name', 'Nama Lengkap')->default('qwe@aweq.com');
        //$form->image('foto')->disk('minio_foto')->readonly()->value(1);
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
    public function saveDokumenUpload($originalFinalName, $newFileName, $arr)
    {
        if ($newFileName) {
            if (@$arr['id']) {
                $dokumen = DokumenPegawai::where('ref_id', $arr['id'])->where('klasifikasi_id', $arr['klasifikasi_id'])->get()->first();
            }
            if (!$dokumen && @$arr['pk1']) {
                $dokumen = DokumenPegawai::where('pk1', $arr['pk1'])->where('klasifikasi_id', $arr['klasifikasi_id'])->where('pk2', $arr['pk2'])->get()->first();
            }

            if (!$dokumen) {
                $dokumen = new DokumenPegawai();
                $dokumen->ref_id = $arr['id'];
                $dokumen->klasifikasi_id = $arr['klasifikasi_id'];
            }
            $dokumen->file = $newFileName;
            $dokumen->nama = $originalFinalName;
            $dokumen->save();
        }
    }
    public function getDokumenUrl($arr)
    {
        if (@$arr['id']) {
            $dokumen = DokumenPegawai::where('ref_id', $arr['id'])->where('klasifikasi_id', $arr['klasifikasi_id'])->get()->first();
        }
        if (!$dokumen && @$arr['pk1']) {
            $dokumen = DokumenPegawai::where('pk1', $arr['pk1'])->where('klasifikasi_id', $arr['klasifikasi_id'])->where('pk2', $arr['pk2'])->get()->first();
        }
        if ($dokumen) {
            if (str_replace(' ', '', $dokumen->file) == '' || $dokumen->file == '-') return 'File tidak ditemukan.';
            else {
                $url = route('admin.download.dokumen',[
                    'f'=>base64_encode($dokumen->file)
                ]);
                return "<a href='{$url}' target='_blank'><i class='fa fa-eye'> Download</a>";
            }
        }
        return "-";
    }
    public function index(Content $content)
    {
        $content
            ->title($this->title())
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->header()->render())
            ->body($this->headerTab());
        if (method_exists($this, 'grid')) {
            $grid = $this->grid();
            $grid->paginate(10);
            $employee = $this->getEmployee();
            if ($this->use_document) {
                $_this = $this;
                $grid->column('dokumen', 'DOKUMEN')->display(function ($cb) use ($employee, $_this) {
                    if ($this->simpeg_id) {
                        $arr = explode("#", $this->simpeg_id);
                        if (sizeof($arr) == 2) {
                            return $_this->getDokumenUrl([
                                'pk1' => $employee->simpeg_id,
                                'pk2' => $arr[1],
                                'klasifikasi_id' => $_this->klasifikasi_id,
                                'id' => $this->id,
                            ]);
                        }
                    }
                    return '-';
                });
            }
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
            $content->body($grid);
            return $content;
        } else if (method_exists($this, 'form')) {
            $form = $this->form();
            $content->body($form);
            return $content;
        }
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
    public function getEmployee()
    {
        $profile_id = $this->getProfileId();
        $e = Employee::findOrFail($profile_id);
        return $e;
    }
    public function destroy($id)
    {
        return $this->form()->destroy($id);
    }
}
