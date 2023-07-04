<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Hukuman extends Model
{
     use ModelTree, AdminBuilder;
     //
     public $table  = 'hukuman';
     public function __construct(array $attributes = [])
     {
         parent::__construct($attributes);
         $this->setTitleColumn('hukuman');
     }
}
