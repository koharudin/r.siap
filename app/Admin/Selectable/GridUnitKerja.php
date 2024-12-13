<?php

namespace App\Admin\Selectable;

use App\Models\UnitKerja;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class GridUnitKerja extends Selectable
{
    public $model = UnitKerja::class;

    public function make()
    {
        $this->column('id', __('ID'));
        $this->column('name', __('NAMA'))->display(function($o) {
            return "<b>".$this->name."</b><br>".$this->getParentName();
        });

        $this->filter(function(Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('name', 'CARI UNIT');
        });
    }
}
