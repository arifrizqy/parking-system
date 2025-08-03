<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ProfileController extends Controller
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
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->email = $request->email;
        $user->save();

        $user->member->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function generateQrMember()
    {
        $member = Auth::user()->member;
        $filePath = "qr/member-{$member->id}.png";
        $fullPath = storage_path('app/public/'.$filePath);

        // Buat folder jika belum ada
        if (! file_exists(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0755, true);
        }

        // Generate QR jika belum ada
        if (! file_exists($fullPath)) {
            $qrImage = QrCode::format('png')
                ->size(300)
                ->generate("MEMBER_ID:{$member->id}");

            file_put_contents($fullPath, $qrImage);
        }

        return response()->download($fullPath);
    }
}
