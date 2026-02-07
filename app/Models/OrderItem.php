<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function order_units(): BelongsTo
    {
        return $this->belongsTo(OrderUnit::class);
    }
    public function master_rab_items(): BelongsTo
    {
        return $this->belongsTo(MasterRabItem::class);
    }
}