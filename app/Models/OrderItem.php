<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;

    protected $guarded =
    [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function UserClients()
    {
        return $this->belongsTo(UserClient::class);
    }
    public function OrderUnits()
    {
        return $this->belongsTo(OrderUnit::class);
    }
    public function RabItems()
    {
        return $this->belongsTo(MasterRabItem::class);
    }
}
