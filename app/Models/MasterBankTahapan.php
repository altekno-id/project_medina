<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBankTahapan extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBankTahapanFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($model) {
            // jika gak ada sesi (proses development belum ada modul login)
            $model->user_client_id = 1;

            // jika sudah ada
            if (Auth::check()) {
                $model->user_client_id = Auth::user()->user_client_id;
            }
        });
    }

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_banks(): BelongsTo
    {
        return $this->belongsTo(MasterBank::class);
    }
    public function unit_progress(): HasMany
    {
        return $this->hasMany(UnitProgres::class);
    }
}
