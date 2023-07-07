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

class KGBController extends Controller
{
    public $title  = 'Kenaikan Gaji Berkala';
    public function index(Content $content)
    {
        
        return $content
            ->title($this->title)
            ->body($this->grid());
    }
    public function grid()
    {
        $grid = new Grid(new Employee());
        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->disableView();
            $actions->add(new DetailPegawaiAction());
        });
        $grid->disableCreateButton();
        // column not in table
        $grid->column('foto')->display(function ($foto) {
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
        })->image('',100,100);
        $grid->column('nip_baru', __('NIP'));
        $grid->column('first_name', __('FIRST NAME'));
        $grid->column('last_name', __('LAST NAME'));
       
        $grid->column('no_sk', __('NOMOR SK'));
        $grid->column('tgl_sk', __('TGL SK'));

        $grid->column('tmt_baru', __('TMT BARU'));
        $grid->column('tmt_lama', __('TMT LAMA'));

        $grid->column('gaji_baru', __('GAJI BARU'));
        $grid->column('gaji_lama', __('GAJI LAMA'));

        $grid->column('pejabat_penetap', __('PEJABAT PENETAP'));

        $grid->expandFilter();  
        $grid->filter(function($filter){    
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('first_name','ilike',"%".$this->input.'%');
        },'Nama Pegawai');
            $filter->like('nip_baru', 'NIP Pegawai');
        });
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-danger'><i class='fa fa-cog'></i> &nbsp; Proses</a>");
            
        });
        return $grid;
    }
}
