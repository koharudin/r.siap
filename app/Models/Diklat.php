<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use \Illuminate\Database\Eloquent\Model;

class Diklat extends Model
{
    public $table = 'diklat';
    use HasFactory;
    use ModelTree, AdminBuilder;
    public $primaryKey = 'id';
    public $timestamps  = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTitleColumn('name');
    }
}
