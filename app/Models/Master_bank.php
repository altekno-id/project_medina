<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master_bank extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBankFactory> */
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
    public function UserLogins()
    {
        return $this->belongsTo(User_login::class);
    }
    public function BankTahapans()
    {
        return $this->hasMany(Master_bank_tahapan::class);
    }
    public function Units()
    {
        return $this->hasMany(Unit::class);
    }
}
