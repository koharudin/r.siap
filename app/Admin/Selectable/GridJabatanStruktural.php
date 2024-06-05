<?php

namespace App\Admin\Selectable;

use App\Models\UnitKerja;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;

class GridJabatanStruktural extends Selectable
{
    public $model = UnitKerja::class;

    public function make()
    {
        $this->model()->orderBy('eselon_id', 'ASC');
        $this->model()->orderBy('order', 'ASC');
        $this->model()->whereNotNull('pejabat_jabatan');
        $this->column('id', __('ID'));
        $this->column('name', __('NAMA'))->display(function($o) {
            return "<b>".$this->pejabat_jabatan."</b><br>".$this->name;
        });

        $this->filter(function(Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('pejabat_jabatan', "Cari Jabatan");
        });
    }
}
