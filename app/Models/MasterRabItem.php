<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class MasterRabItem extends Model
{
    /** @use HasFactory<\Database\Factories\MasterRabItemFactory> */
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

    public function master_rabs(): BelongsTo
    {
        return $this->belongsTo(MasterRab::class, 'master_rab_id');
    }

    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function permintaan_dana_units(): HasMany
    {
        return $this->hasMany(PermintaanDanaUnit::class, 'master_rab_item_id');
    }

    public function user_logins(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }

    public function created_by(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }

    public function updated_by(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }
}
