<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\RiwayatHukuman;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RiwayatHukumanController extends Controller
{
    public $title  = 'Riwayat Hukuman';
    public function index(Content $content)
    {

        return $content
            ->title($this->title)
            ->body($this->grid());
    }
    public function grid()
    {
        $grid = new Grid(new RiwayatHukuman());
        $grid->model()->load('obj_employee');
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->add(new DetailPegawaiAction());
        });
        $grid->disableCreateButton();
        // column not in table
        $grid->column('obj_employee.foto', 'FOTO')->display(function ($foto) {
            $disk = Storage::disk('minio_foto');
            if (Str::of($foto)->trim()->isNotEmpty()) {
                if ($disk->exists($foto)) {
                    $url = $disk->temporaryUrl(
                        $foto,
                        now()->addMinutes(5)
                    );
                    return $url;
                }
            }
            return config("admin.default_avatar");
        })->image('', 100, 100);
        $grid->column('obj_employee.nip_baru', __('NIP'));
        $grid->column('obj_employee.first_name', __('NAMA'));
        $grid->column('tmt_sk', __('TMT SK'))->display(function ($o) {
            return $this->tmt_sk->format('d-m-Y');
        });
        $grid->column('obj_hukuman.name', __('NAMA HUKUMAN'));
        $grid->column('pelanggaran', __('PELANGGARAN'));
        $grid->column('pejabat_penetap_jabatan', 'PEJABAT PENETAP');
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $v = $this->input;
                $query->whereHas('obj_employee', function ($q) use ($v) {
                    $q->where('first_name', 'ilike', "%" . $v . '%');
                });
            }, 'Nama Pegawai');
            $filter->where(function ($query) {
                $v = $this->input;
                $query->whereHas('obj_employee', function ($q) use ($v) {
                    $q->where('nip_baru', 'ilike', "%" . $v . '%');
                });
            }, 'NIP Pegawai');
        });
        return $grid;
    }
}
