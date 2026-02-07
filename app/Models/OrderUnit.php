<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderUnit extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
