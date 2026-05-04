<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MasterKawasanSub extends Model
{
    /** @use HasFactory<\Database\Factories\MasterKawasanSubFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_client_id = 1;
            $model->created_by = 1;
            $model->updated_by = 1;
            if (Auth::check()) {
                $model->user_client_id = Auth::user()->user_client_id;
                $model->created_by = Auth::user()->user_login_id;
                $model->updated_by = Auth::user()->user_login_id;
            }
        });

        static::updating(function ($model) {
            $model->updated_by = 1;
            if (Auth::check()) {
                $model->updated_by = Auth::user()->user_login_id;
            }
        });
    }

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_kawasans(): BelongsTo
    {
        return $this->belongsTo(MasterKawasan::class, 'master_kawasan_id');
    }
    public function master_kawasan_sub_bloks(): HasMany
    {
        return $this->hasMany(MasterKawasanSubBlok::class, 'master_kawasan_sub_id');
    }
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class, 'master_kawasan_sub_blok_id');
    }
}
