<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = ['owner_id', 'owner_type', 'vehicle_type', 'number_plat'];

    public function owner()
    {
        return $this->morphTo();
    }

    public function logs()
    {
        return $this->hasMany(ParkingLog::class);
    }
}
