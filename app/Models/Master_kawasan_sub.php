<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Master_kawasan_sub extends Model
{
    /** @use HasFactory<\Database\Factories\MasterKawasanSubFactory> */
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
    public function Kawasans()
    {
        return $this->belongsTo(Master_kawasan::class);
    }
    public function Units()
    {
        return $this->hasMany(Unit::class);
    }
}
