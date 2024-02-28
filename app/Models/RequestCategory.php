<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RequestCategory extends Model
{
    use HasFactory;
    public $table  = 'request_category';
    public $dates = ['birth_date'];
    private $cacheKeyPrefix = "request_category_id_";

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
