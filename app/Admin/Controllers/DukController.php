<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\DetailPegawaiAction;
use App\Admin\Extensions\Tools\ProsesDUK;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Navbar\RefreshButton;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jxlwqq\DataTable\DataTable;

class DukController extends Controller
{
    public $title  = 'Daftar Urutan Kepangkatan';
    public function index(Content $content)
    {
        // table
        $headers = ['Id', 'Email', 'Name', 'Company'];
        $rows = [
            [1, 'labore21@yahoo.com', 'Ms. Clotilde Gibson', 'Goodwin-Watsica'],
            [2, 'omnis.in@hotmail.com', 'Allie Kuhic', 'Murphy, Koepp and Morar'],
            [3, 'quia65@hotmail.com', 'Prof. Drew Heller', 'Kihn LLC'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
            [4, 'xet@yahoo.com', 'William Koss', 'Becker-Raynor'],
            [5, 'ipsa.aut@gmail.com', 'Ms. Antonietta Kozey Jr.', 'Goooogle'],
        ];

        $style = ['table-bordered', 'table-hover', 'table-striped'];

        $options = [
            'paging' => true,
            'lengthChange' => false,
            'searching' => false,
            'ordering' => true,
            'info' => true,
            'autoWidth' => false,
        ];

        $dataTable = new DataTable($headers, $rows, $style, $options);
        $box = new Box('',$dataTable);
        return $content
        ->title($this->title)
        ->body($box);
    }
    public function index2(Content $content)
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
        $grid->column('no_duk', __('NO DUK'));
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
        })->image('', 100, 100);
        $grid->column('first_name', __('FIRST NAME'));
        $grid->column('last_name', __('LAST NAME'));
        $grid->column('nip_baru', __('NIP'));
        $grid->column('gol_ruang', __('GOL RUANG'));
        $grid->column('tmt_pangkat', __('TMT PANGKAT'));
        $grid->column('jabatan', __('JABATAN'));
        $grid->column('tmt_jabatan', __('TMT JABATAN'));
        $grid->column('eselon', __('ESELON'));
        $grid->column('tmt_eselon', __('TMT ESELON'));
        $grid->expandFilter();
        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->where(function ($query) {
                $query->where('first_name', 'ilike', "%" . $this->input . '%');
            }, 'Nama Pegawai');
            $filter->like('nip_baru', 'NIP Pegawai');
        });
        $grid->tools(function ($tools) {
            $tools->append("<a class='btn btn-sm btn-danger'><i class='fa fa-cog'></i> &nbsp; Proses</a>");
            $tools->append(new ProsesDUK());
        });

        $script = <<<SCRIPT
            console.log('{$grid->tableID}');
        SCRIPT;
        Admin::script($script);
        return $grid;
    }
}
