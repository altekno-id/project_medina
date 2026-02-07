<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKawasanSub extends Model
{
    /** @use HasFactory<\Database\Factories\MasterKawasanSubFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_kawasans(): BelongsTo
    {
        return $this->belongsTo(MasterKawasan::class);
    }
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
