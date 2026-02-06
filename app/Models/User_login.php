<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_login extends Model
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
        return $this->belongsTo(User_client::class);
    }
    public function UserRoles()
    {
        return $this->belongsTo(User_role::class);
    }
    public function Rabs()
    {
        return $this->hasMany(Master_rab::class);
    }
    public function Kawasans()
    {
        return $this->hasMany(Master_kawasan::class);
    }
    public function Banks()
    {
        return $this->hasMany(Master_bank::class);
    }
    public function Orders()
    {
        return $this->hasMany(Order::class);
    }

}
