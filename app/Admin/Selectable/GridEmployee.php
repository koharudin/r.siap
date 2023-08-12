<?php
namespace App\Admin\Selectable;

use App\Models\Employee;
use App\Models\Jabatan;
use Encore\Admin\Grid\Filter;
use Encore\Admin\Grid\Selectable;


class GridEmployee extends Selectable
{
    public $model = Employee::class;

    public function make()
    {
        $this->column('nip_baru',__('NIP'));
        $this->column('first_name',__('NAMA'));

        $this->filter(function (Filter $filter) {
            $filter->disableIdFilter();
            $filter->ilike('first_name');
        });
    }
}