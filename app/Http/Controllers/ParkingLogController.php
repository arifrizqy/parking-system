<?php

namespace App\Http\Controllers;

use App\Models\ParkingLog;

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
}
