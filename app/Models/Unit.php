<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_kawasan_subs(): BelongsTo
    {
        return $this->belongsTo(MasterKawasanSub::class);
    }
    public function master_rabs(): BelongsTo
    {
        return $this->belongsTo(MasterRab::class);
    }
    public function master_banks(): BelongsTo
    {
        return $this->belongsTo(MasterBank::class);
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

}
