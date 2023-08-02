<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Illuminate\Support\Facades\URL;

class HapusUsulanAction extends RowAction
{
    protected $kategori_id;
    protected $record_id;
    public function __construct($kategori_id,$record_id)
    {
        $this->kategori_id = $kategori_id;
        $this->record_id = $record_id;
    }
    public $name = 'Usulan Penghapusan';

    /**
     * @return  string
     */
    public function href()
    {
        return route('admin.hapus-usulan-from-record',[
            'kategori_id'=>$this->kategori_id,
            'record_ref_id'=>$this->record_id
        ]);
    }
}