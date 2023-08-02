<?php

namespace App\Admin\Actions;

use Encore\Admin\Actions\RowAction;
use Encore\Admin\Facades\Admin;
use Illuminate\Support\Facades\URL;

class UbahUsulanAction extends RowAction
{
    public $name = 'Usulan Perubahan';
    protected $kategori_id;
    protected $record_id;
    public function __construct($kategori_id, $record_id)
    {
        $this->kategori_id = $kategori_id;
        $this->record_id = $record_id;
    }
    /**
     * @return  string
     */
    public function href()
    {
        return route('admin.ubah-usulan-from-record', [
            'kategori_id' => $this->kategori_id,
            'record_ref_id' => $this->record_id
        ]);
    }
}
