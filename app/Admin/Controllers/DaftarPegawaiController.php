<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DaftarPegawaiController extends Controller
{
    public $title  = 'Daftar Pegawai Aktif';
    public function index(Content $content)
    {

        return $content
            ->title($this->title)
            ->body($this->grid());
    }
    public function grid()
    {
        $grid = new Grid(new Employee());
        $grid->model()->whereIn('status_pegawai_id', [1, 2, 23]);
        $grid->model()->orderBy('first_name', 'asc');
        $grid->paginate(10);
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->add(new DetailPegawaiAction());
        });
        $grid->disableCreateButton();
        $grid->disableRowSelector();
        $grid->column('first_name', __('Nama Pegawai'))->display(function ($o) {
            $statusLabel = ($this->status_pegawai_id == 2) ? 'PNS' : (($this->status_pegawai_id == 23) ? 'PPPK' : '');

            return $this->first_name . " <br> " . $this->nip_baru . "<br> ASN: " . $statusLabel;
        });
        $grid->column('email_kantor', __('EMAIL KANTOR'));
        $grid->column('email', __('EMAIL'));
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('first_name', 'ilike', "%" . $this->input . '%');
            }, 'Nama Pegawai');
            $filter->like('nip_baru', 'NIP Pegawai');
        });
        return $grid;
    }
}