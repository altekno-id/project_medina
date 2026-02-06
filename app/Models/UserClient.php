<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =
    [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function UserLogins()
    {
        return $this->hasMany(UserLogin::class);
    }
    public function UserRoles()
    {
        return $this->hasMany(UserRole::class);
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
    public function Ordes()
    {
        return $this->hasMany(Order::class);
    }
    public function RabItems()
    {
        return $this->hasMany(MasterRabItem::class);
    }
    public function BankTahapans()
    {
        return $this->hasMany(MasterBankTahapan::class);
    }
    public function Units()
    {
        return $this->hasMany(Unit::class);
    }
    public function UnitProgress()
    {
        return $this->hasMany(UnitProgres::class);
    }
    public function OrderUnits()
    {
        return $this->hasMany(OrderUnit::class);
    }
    public function Files()
    {
        return $this->hasMany(File::class);
    }
    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}