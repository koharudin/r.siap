<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    public $table  = 'employee';
    public $primaryKey = 'id';
    public $timestamps  = true;

    public function obj_agama(){
        return $this->hasOne(Agama::class,'id','agama_id');
    }
}
