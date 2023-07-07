<?php
namespace App\Admin\Selectable;

use App\Models\PejabatPenetap;
use App\Models\UnitKerja;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class GridPejabatPenetap extends Selectable
{
    public $model = PejabatPenetap::class;

    public function make()
    {
        $this->column('id',__('ID'));
        $this->column('nama',__('NAMA'));
        $this->column('nip',__('NIP'));
        $this->column('jabatan',__('JABATAN'));

        $this->filter(function (Filter $filter) {
            $filter->like('name');
        });
    }
}