<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penghargaan extends Model
{
     use HasFactory;
     use ModelTree, AdminBuilder;
     public $table  = 'penghargaan';
     public function __construct(array $attributes = [])
     {
          parent::__construct($attributes);
          $this->setTitleColumn('name');
     }
}
