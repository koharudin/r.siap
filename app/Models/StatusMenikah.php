<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatusMenikah extends Model
{
     public $table  = 'status_menikah';
     public $primaryKey = 'id';

     public const MENIKAH = 1;
     public const CERAI = 2;
     public const MENINGGAL = 3;
}
