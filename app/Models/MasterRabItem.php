<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRabItem extends Model
{
    /** @use HasFactory<\Database\Factories\MasterRabItemFactory> */
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_rabs(): BelongsTo
    {
        return $this->belongsTo(MasterRab::class);
    }
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
