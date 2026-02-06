<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UnitProgres extends Model
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
    public function Units()
    {
        return $this->belongsTo(Unit::class);
    }
    public function BankTahapans()
    {
        return $this->belongsTo(MasterBankTahapan::class);
    }
}
