<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ParkingLog;

class GuestLogDataController extends Controller
{
    public function show($id)
    {
        $guestLog = ParkingLog::with(['vehicle', 'vehicle.owner'])->findOrFail($id);

        return response()->json([
            'parking' => [
                'id' => $guestLog->id,
                'enter_at' => $guestLog->enter_at,
                'leave_at' => $guestLog->leave_at,
            ],
            'vehicle' => [
                'number_plat' => $guestLog->vehicle->number_plat,
                'vehicle_type' => ucfirst($guestLog->vehicle->vehicle_type),
            ],
            'guest' => [
                'name' => $guestLog->vehicle->owner->name,
            ],
        ]);
    }
}
