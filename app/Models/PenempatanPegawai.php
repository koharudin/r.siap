<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenempatanPegawai extends Model
{
     use HasFactory;
     use ModelTree, AdminBuilder;
     public $table  = 'penempatan_pegawai';
     public function __construct(array $attributes = [])
     {
          parent::__construct($attributes);
          $this->setTitleColumn('nama_jabatan');
     }
}
