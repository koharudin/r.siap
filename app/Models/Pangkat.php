<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pangkat extends Model
{
     public $table  = 'pangkat';
     public $primaryKey = 'id';
     public $incrementing = false;

     public function getTextAttribute(){
          return $this->name." ({$this->kode})";
     }
}
