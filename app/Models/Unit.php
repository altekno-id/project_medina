<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Unit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected static function booted(): void
    {
        static::addGlobalScope('client', function (Builder $builder) {
            $clientId = Auth::check()
                ? Auth::user()->user_client_id
                : 1;

            $builder->where(
                $builder->getModel()->getTable() . '.user_client_id',
                $clientId
            );
        });

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->user_client_id = Auth::user()->user_client_id;
                $model->created_by = Auth::user()->user_login_id;
                $model->updated_by = Auth::user()->user_login_id;
            } else {
                $model->user_client_id = 1;
                $model->created_by = 1;
                $model->updated_by = 1;
            }
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::check()
                ? Auth::user()->user_login_id
                : 1;
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
    public function master_kawasan_subs(): BelongsTo
    {
        return $this->belongsTo(MasterKawasanSub::class, 'master_kawasan_sub_id');
    }
    public function master_kawasan_sub_bloks(): BelongsTo
    {
        return $this->belongsTo(MasterKawasanSubBlok::class, 'master_kawasan_sub_blok_id');
    }
    public function master_rabs(): BelongsTo
    {
        return $this->belongsTo(MasterRab::class, 'master_rab_id');
    }
    public function master_banks(): BelongsTo
    {
        return $this->belongsTo(MasterBank::class, 'master_bank_id');
    }
    public function unit_progress(): HasMany
    {
        return $this->hasMany(UnitProgres::class);
    }
    public function order_units(): HasMany
    {
        return $this->hasMany(OrderUnit::class);
    }
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
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
