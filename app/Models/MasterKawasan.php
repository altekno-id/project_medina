<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterKawasan extends Model
{
    /** @use HasFactory<\Database\Factories\MasterKawasanFactory> */
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
    public function KawasanSubs()
    {
        return $this->hasMany(MasterKawasan::class);
    }
    public function Files()
    {
        return $this->hasMany(File::class);
    }
}
