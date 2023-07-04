<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agama extends Model
{
    use HasFactory;
    public $name;
    public $timestamps = false;
    public $table = 'agama';
}
