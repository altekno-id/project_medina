<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLogin extends Model
{
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
    public function UserRoles()
    {
        return $this->belongsTo(UserRole::class);
    }
    public function Rabs()
    {
        return $this->hasMany(MasterRab::class);
    }
    public function Kawasans()
    {
        return $this->hasMany(MasterKawasan::class);
    }
    public function Banks()
    {
        return $this->hasMany(MasterBank::class);
    }
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

}
