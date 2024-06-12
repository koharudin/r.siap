<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LineApproval extends Model
{
    use HasFactory;
    public $table  = 'line_approval';
    private $cacheKeyPrefix = "line_approval_id";
    public $casts = [
        'approval_hierarchy' => "json"
    ];

    public function obj_request_category()
    {
        return $this->hasOne(RequestCategory::class, 'id', 'request_category_id');
    }

    protected static function booted(): void
    {
        self::creating(function (RequestCategory $record) {
            $record->uuid = Str::uuid()->toString();
        });

        self::created(function ($model) {
            Cache::remember($model->cacheKeyPrefix . $model->id, 60 * 60 * 24, function () use ($model) {
                return $model;
            });
        });
        self::updated(function ($model) {
            Cache::remember($model->cacheKeyPrefix . $model->id, 60 * 60 * 24, function () use ($model) {
                return $model;
            });
        });
        self::deleted(function ($model) {
            Cache::forget($model->cacheKeyPrefix . $model->id);
        });
    }
    // other methods goes here
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
