<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterRab extends Model
{
    /** @use HasFactory<\Database\Factories\MasterRabFactory> */
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
    public function UserLogins()
    {
        return $this->belongsTo(UserLogin::class);
    }
    public function Units()
    {
        return $this->hasMany(Unit::class);
    }
}