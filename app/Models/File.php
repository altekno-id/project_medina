<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function user_clients(): BelongsTo
    {
        return $this->belongsTo(UserClient::class);
    }
    public function master_kawasans(): BelongsTo
    {
        return $this->belongsTo(MasterKawasan::class);
    }
    public function units(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
