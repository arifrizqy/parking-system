<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
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
    public function store(Request $request)
    {
        $data = $request->all();
        $data['vehicle_type'] = strtolower($data['vehicle_type']);

        $validated = validator($data, [
            'vehicle_type' => 'required|in:mobil,motor',
            'number_plat' => 'required|unique:vehicles,number_plat',
        ])->validate();

        $user = Auth::user();

        $user->member->vehicles()->create($validated);

        return redirect()->back()->with('success', 'Vehicle added.');
    }

    public function update(Request $request, Vehicle $vehicle)
    {
        $data = $request->all();
        $data['vehicle_type'] = strtolower($data['vehicle_type']);

        $validated = validator($data, [
            'vehicle_type' => 'required|in:mobil,motor',
            'number_plat' => 'required|unique:vehicles,number_plat,'.$vehicle->id,
        ])->validate();

        if ($vehicle->owner_type !== Member::class || $vehicle->owner_id !== Auth::user()->member->id) {
            abort(403);
        }

        $vehicle->update([
            'vehicle_type' => $validated['vehicle_type'],
            'number_plat' => strtoupper($validated['number_plat']),
        ]);

        return redirect()->back()->with('success', 'Vehicle updated.');
    }

    public function destroy(Vehicle $vehicle)
    {
        $user = Auth::user();

        if ($vehicle->owner_type !== get_class($user->member) || $vehicle->owner_id !== $user->member->id) {
            abort(403, 'Unauthorized');
        }

        $vehicle->delete();

        return redirect()->back()->with('success', 'Vehicle deleted.');
    }
}
