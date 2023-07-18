<?php
namespace App\Admin\Selectable;

use App\Models\PejabatPenetap;
use App\Models\Penghargaan;
use App\Models\UnitKerja;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class GridPenghargaan extends Selectable
{
    public $model = Penghargaan::class;

    public function make()
    {
        $this->column('id',__('ID'));
        $this->column('name',__('NAMA'));

        $this->filter(function (Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('name');
        });
    }
}