<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingLogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $logs = ParkingLog::with(['vehicle.owner', 'admin'])->latest()->get();

        return view('parking', compact('logs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'member_id' => 'required|exists:members,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $vehicle = Vehicle::findOrFail($validated['vehicle_id']);

        ParkingLog::create([
            'vehicle_id' => $vehicle->id,
            'admin_user_id' => Auth::id(),
            'owner_type' => get_class($vehicle->owner),
            'owner_id' => $vehicle->owner->id,
            'enter_at' => now(),
        ]);

        return back()->with('success', 'Log parkir berhasil ditambahkan.');
    }

    public function leave(ParkingLog $parkingLog)
    {
        if (! is_null($parkingLog->leave_at)) {
            return redirect()->back()->with('error', 'Kendaraan sudah keluar.');
        }

        $parkingLog->update([
            'leave_at' => now(),
            'admin_user_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Waktu keluar berhasil dicatat.');
    }

    public function destroy(ParkingLog $parkingLog)
    {
        $parkingLog->delete();

        return redirect()->back()->with('success', 'Log parkir berhasil dihapus.');
    }
}
