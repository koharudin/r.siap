<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GolonganDarah extends Model
{
    use HasFactory;

    public $table = 'golongan_darah';
    public $incrementing = false;
}
