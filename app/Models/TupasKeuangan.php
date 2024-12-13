<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TupasKeuangan extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'tupas_keuangan';
    public $primaryKey = 'id';
}
