<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pendidikan extends Model
{
    use HasFactory;
    use ModelTree, AdminBuilder;
    public $table  = 'pendidikan';
    public $primaryKey = 'id';
    public $timestamps  = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTitleColumn('name');
    }
    public function obj_parent()
    {
        return $this->hasOne(Pendidikan::class, 'id', 'parent_id');
    }
}
