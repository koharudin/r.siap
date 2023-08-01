<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\URL;

class UbahUsulanAction extends RowAction
{
    public $name = 'Usulan Perubahan';
    protected $kategori_id;
    public function __construct($kategori_id)
    {
        $this->kategori_id = $kategori_id;
    }
    /**
     * @return  string
     */
    public function href()
    {
        return route('admin.ubah-usulan-from-record',[
            'kategori_id'=>$this->kategori_id,
            'record_id'=>$this->getKey()
        ]);
    }
}
