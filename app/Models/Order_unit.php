<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_unit extends Model
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
        return $this->belongsTo(User_client::class);
    }
    public function Orders()
    {
        return $this->belongsTo(Order::class);
    }
    public function Units()
    {
        return $this->belongsTo(Unit::class);
    }
    public function OrderItems()
    {
        return $this->hasMany(Order_item::class);
    }
}
