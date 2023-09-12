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
use Illuminate\Database\Eloquent\Model;
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
    public function links()
    {
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
        return $links;
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
        if ($dokumen) {
            if (str_replace(' ', '', $dokumen->file) == '' || $dokumen->file == '-') return 'File tidak ditemukan.';
            else {
                $url = route('admin.download.dokumen', [
                    'f' => base64_encode($dokumen->file)
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
            ->body($this->header()->render());
        if (method_exists($this, 'grid')) {
            $grid = $this->grid();
            $grid->paginate(10);
            $employee = $this->getEmployee();
            if ($this->use_document) {
                $_this = $this;
                $grid->column('dokumen', 'DOKUMEN')->display(function ($cb) use ($employee, $_this) {
                    return $_this->getDokumenUrl([
                        'klasifikasi_id' => $_this->klasifikasi_id,
                        'id' => $this->id,
                    ]);
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
            $c = $grid->render();
        } else if (method_exists($this, 'form')) {
            $form = $this->form();
            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
            $c = $form;
        }
        $employee = $this->getEmployee();
        $content->view("v_profile_sidebar", ['g' => $c, 'links' => $this->links(), 'e' => $employee]);
        return $content;
    }

    public function store()
    {
        $form = $this->form();
        $this->setDokumenPendukung($form);
        return $form->saving(function (Form $form) {
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
        $c = $this->form();
        $this->setDokumenPendukung($c);
        $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'));
        $content->view("v_profile_sidebar", ['g' => $c, 'links' => $this->links(), 'e' => $this->getEmployee()]);
        return $content;
    }
    public function show($profile_id, $id, Content $content)
    {
        $c = $this->detail($id);
        $_this = $this;
        $c->panel()
            ->tools(function ($tools) use ($_this) {
                if (!Admin::user()->can("delete-{$_this->activeTab}")) {
                    $tools->disableDelete();
                }
                if (!Admin::user()->can("edit-{$_this->activeTab}l")) {
                    $tools->disableEdit();
                }
            });;
        $content
            ->title($this->title())
            ->description($this->description['show'] ?? trans('admin.show'));
        $content->view("v_profile_sidebar", ['g' => $c, 'links' => $this->links(), 'e' => $this->getEmployee()]);
        return $content;
    }

    public function edit($profile_id, $id, Content $content)
    {
        Permission::check("edit-{$this->activeTab}");
        $form  = $this->form();
        $form->disableCreatingCheck();
        $form->disableEditingCheck();
        $form->disableViewCheck();
        $profile_id = $this->getProfileId();
        $form->edit($id);

        $this->setDokumenPendukung($form);
        $owner_id = $form->model()->employee_id;
        if ($profile_id != $owner_id) {
            abort(401, "Wrong owner. Profile ID $profile_id . Owner ID $owner_id");
        }
        $content
            ->title($this->title())
            ->description($this->description['create'] ?? trans('admin.create'));
        $content->view("v_profile_sidebar", ['g' => $form, 'links' => $this->links(), 'e' => $this->getEmployee()]);
        return $content;
    }
    public function update($profile_id, $id)
    {
        Permission::check("edit-{$this->activeTab}");
        $form = $this->form();
        $this->setDokumenPendukung($form);
        return $form->update($id);
    }
    public function destroy($id)
    {
        Permission::check("delete-{$this->activeTab}");
        return $this->form()->destroy($id);
    }
    public function getProfileId()
    {
        return request()->profile_uid ? request()->profile_uid : request()->profile_id;
    }
    public function getEmployee()
    {
        $profile_id = $this->getProfileId();
        $e = Employee::findOrFail($profile_id);
        return $e;
    }

    public function setDokumenPendukung(Form &$form)
    {
        if($this->use_document) {
            $_this = $this;
            $d = $form->file('dokumen', 'DOKUMEN PENDUKUNG')->rules([
                'mimes:pdf',
                'max:2048'
            ], [
                'mimes' => 'DOKUMEN HANYA DIPERBOLEHKAN FORMAT PDF',
                'max' => 'UKURAN DOKUMEN MELEBIHI 2MB'
            ])->disk('minio_dokumen')->name(function($file) use($_this) {
                return $_this->getEmployee()->nip_baru."_".md5(uniqid()).".".$file->guessExtension();
            });
            $form->saving(function(Form $form) {
            });
            $form->submitted(function(Form $form) {
                $form->ignore('dokumen');
            });
            $form->saved(function(Form $form) use($d, $_this) {
                $file = request()->file('dokumen');
                if($file) {
                    $newFileName = $d->prepare($file);
                    $keys = explode("#", $form->model()->simpeg_id);
                    $arr = [
                        'id' => $form->model()->id,
                        'klasifikasi_id' => $_this->klasifikasi_id,
                        'pk1' => sizeof($keys) == 2 ? $keys[0] : null,
                        'pk2' => sizeof($keys) == 2 ? $keys[1] : null,
                    ];
                    $_this->saveDokumenUpload($file->getClientOriginalName(), $newFileName, $arr);
                }
            });
        }
    }
}
