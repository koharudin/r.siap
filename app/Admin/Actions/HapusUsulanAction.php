<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\URL;

class HapusUsulanAction extends RowAction
{
    protected $kategori_id;
    public function __construct($kategori_id)
    {
        $this->kategori_id = $kategori_id;
    }
    public $name = 'Usulan Penghapusan';

    /**
     * @return  string
     */
    public function href()
    {
        return route('admin.hapus-usulan-from-record',[
            'kategori_id'=>$this->kategori_id,
            'record_id'=>$this->getKey()
        ]);
    }
}