<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
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
        return view('guest');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'needs' => 'required|string|max:255',
            'vehicle_type' => 'required|in:mobil,motor',
            'number_plat' => 'required|unique:vehicles,number_plat',
        ]);

        DB::transaction(function () use ($data) {
            $guest = Guest::create([
                'name' => $data['name'],
                'no_telp' => $data['no_telp'],
                'needs' => $data['needs'],
            ]);

            $vehicle = $guest->vehicles()->create([
                'vehicle_type' => $data['vehicle_type'],
                'number_plat' => strtoupper($data['number_plat']),
            ]);

            $vehicle->logs()->create([
                'in_time' => now(),
                'admin_user_id' => Auth::id(), // ✅ tambahkan ini
            ]);
        });

        return redirect()->back()->with('success', 'Guest and vehicle logged successfully.');
    }
}
