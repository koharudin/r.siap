<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StatusAnak extends Model
{
    use HasFactory;
    public $table = 'status_anak';
    public $incrementing = false;
}
