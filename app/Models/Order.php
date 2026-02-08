<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function user_logins(): BelongsTo
    {
        return $this->belongsTo(UserLogin::class);
    }
    public function order_units(): HasMany
    {
        return $this->hasMany(OrderUnit::class);
    }

}