<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class Request extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $table  = 'requests';
    private $cacheKeyPrefix = "request_id_";

    //action : 1=createNew,2=edit,3=delete
    public function obj_logs()
    {
        return $this->hasMany(RequestLog::class, 'request_id', 'id');
    }
    public function obj_employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
    public function obj_status(){
        return $this->hasOne(RequestStep::class,'id','status_id');
    } 
    public function obj_kategori(){
        return $this->hasOne(RequestCategory::class,'id','category_id');
    } 
    protected static function booted(): void
    {
        self::creating(function (Request $record) {
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

    public function scopeInboxVerifikator($query)
    {
        $query->whereIn('status_id', [RequestStep::REVISI, RequestStep::TOLAK, RequestStep::SEND, RequestStep::INVERIFIKASI, RequestStep::TERIMA]);
    }
    public function scopeMyInboxVerifikator($query, $verifikator_id)
    {
        $query->where("verifikator_id", $verifikator_id);
        $query->whereIn('status_id', [RequestStep::REVISI, RequestStep::TOLAK,  RequestStep::INVERIFIKASI, RequestStep::TERIMA]);
    }

    public $date = ['date_created'];
    public $casts = ['data' => 'json'];
}
