<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\URL;

class CustomRowAction extends RowAction
{
    public $name = 'Usulan Perubahan';
    protected $href;
    public function __construct($name, $href)
    {
        $this->name = $name;
        $this->href = $href;
    }
    /**
     * @return  string
     */
    public function href()
    {
        return $this->href;
    }
}
