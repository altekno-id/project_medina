<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRabItem extends Model
{
    /** @use HasFactory<\Database\Factories\MasterRabItemFactory> */
    use HasFactory, SoftDeletes;

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
    public function Rabs()
    {
        return $this->belongsTo(MasterRab::class);
    }
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}