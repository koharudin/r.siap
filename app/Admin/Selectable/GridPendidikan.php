<?php
namespace App\Admin\Selectable;

use App\Models\Pendidikan;
use App\Models\UnitKerja;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class GridPendidikan extends Selectable
{
    public $model = Pendidikan::class;

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