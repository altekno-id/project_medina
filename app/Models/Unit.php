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
        return $this->belongsTo(User_client::class);
    }
    public function KawasanSubs()
    {
        return $this->belongsTo(Master_kawasan_sub::class);
    }
    public function Rabs()
    {
        return $this->belongsTo(Master_rab::class);
    }
    public function Banks()
    {
        return $this->belongsTo(Master_bank::class);
    }
    public function UnitProgress()
    {
        return $this->hasMany(Unit_progres::class);
    }
    public function OrderUnits()
    {
        return $this->hasMany(Order_unit::class);
    }
    public function Files()
    {
        return $this->hasMany(File::class);
    }

}
