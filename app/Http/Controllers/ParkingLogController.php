<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

        $log = ParkingLog::create([
            'vehicle_id' => $vehicle->id,
            'admin_user_id' => Auth::id(),
            'owner_type' => get_class($vehicle->owner),
            'owner_id' => $vehicle->owner->id,
            'enter_at' => now(),
        ]);

        $qrCode = QrCode::size(200)->generate("LOG_ID:{$log->id}");

        return redirect()->route('parking-log')
            ->with('qr_code', $qrCode)
            ->with('qr_created_at', Carbon::now());
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
