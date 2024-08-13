<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LineApprovalRequest extends Model
{
    use HasFactory;
    public $table  = 'line_approval_request';
    
}
