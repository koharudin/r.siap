<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisKP extends Model
{
     public $table  = 'jenis_kp';
     public $primaryKey = 'id';
     public const KP_REGULER =1;
}
