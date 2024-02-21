<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitKerja extends Model
{
    use HasFactory;
    use ModelTree, AdminBuilder;
    public $table = 'unit_kerja';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->setTitleColumn('name');
    }
    public function obj_eselon()
    {
        return $this->hasOne(Eselon::class, 'id', 'eselon_id');
    }
    public function getNameWithParentAttribute()
    {
        $parentName = $this->parent ? " - " . $this->parent->name : "";
        return $this->name . $parentName;
    }
    protected $hidden = ['path'];
}
