<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table  = 'country';
    public $primaryKey = 'id';
    public $timestamps  = true;
    public $incrementing = false;
}
