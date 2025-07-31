<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ParkingLog extends Model
{
    use HasFactory;

    protected $fillable = ['vehicle_id', 'admin_user_id', 'enter_at', 'leave_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_user_id');
    }
}
