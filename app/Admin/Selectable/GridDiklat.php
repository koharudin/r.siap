<?php
namespace App\Admin\Selectable;

use App\Models\Diklat;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class GridDiklat extends Selectable
{
    public $model = Diklat::class;

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