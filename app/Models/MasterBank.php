<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBank extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBankFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function user_logins(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }
    public function master_bank_tahapans(): HasMany
    {
        return $this->hasMany(MasterBankTahapan::class);
    }
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
