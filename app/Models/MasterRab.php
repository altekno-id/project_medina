<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MasterRab extends Model
{
    /** @use HasFactory<\Database\Factories\MasterRabFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            // jika gak ada sesi (proses development belum ada modul login)
            $model->user_client_id = 1;
            $model->user_login_id = 1;

            // jika sudah ada
            if (Auth::check()) {
                $model->user_client_id = Auth::user()->user_client_id;
                $model->user_login_id = Auth::user()->user_login_id;
            }
        });
    }

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function user_logins(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
