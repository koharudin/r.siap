<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusUsulan extends Model
{
    use HasFactory;
    public $table = 'status_usulan';
    public $incrementing = false;
}