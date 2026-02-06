<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterBankTahapan extends Model
{
    /** @use HasFactory<\Database\Factories\MasterBankTahapanFactory> */
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
    public function Banks()
    {
        return $this->belongsTo(MasterBank::class);
    }
    public function UnitProgress()
    {
        return $this->hasMany(UnitProgres::class);
    }
}
