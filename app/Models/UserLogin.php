<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLogin extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function user_roles(): BelongsTo
    {
        return $this->belongsTo(UserRole::class);
    }
    public function master_rabs(): HasMany
    {
        return $this->hasMany(MasterRab::class);
    }
    public function master_kawasans(): HasMany
    {
        return $this->hasMany(MasterKawasan::class);
    }
    public function master_banks(): HasMany
    {
        return $this->hasMany(MasterBank::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
