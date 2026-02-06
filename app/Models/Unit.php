<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
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
    public function KawasanSubs()
    {
        return $this->belongsTo(MasterKawasanSub::class);
    }
    public function Rabs()
    {
        return $this->belongsTo(MasterRab::class);
    }
    public function Banks()
    {
        return $this->belongsTo(MasterBank::class);
    }
    public function UnitProgress()
    {
        return $this->hasMany(UnitProgres::class);
    }
    public function OrderUnits()
    {
        return $this->hasMany(OrderUnit::class);
    }
    public function Files()
    {
        return $this->hasMany(File::class);
    }

}
