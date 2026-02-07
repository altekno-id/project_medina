<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserClient extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user_logins(): HasMany
    {
        return $this->hasMany(UserLogin::class);
    }
    public function user_roles(): HasMany
    {
        return $this->hasMany(UserRole::class);
    }
    public function master_rabs(): HasMany
    {
        return $this->hasMany(MasterRab::class);
    }
    public function master_kawasans(): HasMany
    {
        return $this->hasMany(MasterKawasan::class);
    }
    public function master_banks(): HasMany
    {
        return $this->hasMany(MasterBank::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
    public function master_rab_items(): HasMany
    {
        return $this->hasMany(MasterRabItem::class);
    }
    public function master_bank_tahapans(): HasMany
    {
        return $this->hasMany(MasterBankTahapan::class);
    }
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
    public function unit_progress(): HasMany
    {
        return $this->hasMany(UnitProgres::class);
    }
    public function order_units(): HasMany
    {
        return $this->hasMany(OrderUnit::class);
    }
    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
    public function order_items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
