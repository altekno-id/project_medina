<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
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
    public function UserLogins()
    {
        return $this->belongsTo(UserLogin::class);
    }
    public function OrderUnits()
    {
        return $this->hasMany(OrderUnit::class);
    }

}
