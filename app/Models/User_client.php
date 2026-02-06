<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_client extends Model
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
        return $this->hasMany(User_login::class);
    }
    public function UserRoles()
    {
        return $this->hasMany(User_role::class);
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
    public function Ordes()
    {
        return $this->hasMany(Order::class);
    }
    public function RabItems()
    {
        return $this->hasMany(Master_rab_item::class);
    }
    public function BankTahapans()
    {
        return $this->hasMany(Master_bank_tahapan::class);
    }
    public function Units()
    {
        return $this->hasMany(Unit::class);
    }
    public function UnitProgress()
    {
        return $this->hasMany(Unit_progres::class);
    }
    public function OrderUnits()
    {
        return $this->hasMany(Order_unit::class);
    }
    public function Files()
    {
        return $this->hasMany(File::class);
    }
    public function OrderItems()
    {
        return $this->hasMany(Order_item::class);
    }
}
