<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order_item extends Model
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
    public function OrderUnits()
    {
        return $this->belongsTo(Order_unit::class);
    }
    public function RabItems()
    {
        return $this->belongsTo(Master_rab_item::class);
    }
}