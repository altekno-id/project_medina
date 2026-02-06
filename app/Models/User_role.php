<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_role extends Model
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
    public function UserLogins()
    {
        return $this->hasMany(User_login::class);
    }

}