<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nID' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:siswa,pegawai'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $hashedPassword = Hash::make($data['password']);

        if ($data['type'] === 'pegawai' && Member::where('nip', $data['nID'])->exists()) {
            return back()->withErrors(['nID' => 'NIP sudah digunakan']);
        }

        if ($data['type'] === 'siswa' && Member::where('nisn', $data['nID'])->exists()) {
            return back()->withErrors(['nID' => 'NISN sudah digunakan']);
        }

        $member = Member::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'nip' => $data['type'] === 'pegawai' ? $data['nID'] : null,
            'nisn' => $data['type'] === 'siswa' ? $data['nID'] : null,
        ]);

        return $member->user()->create([
            'email' => $data['email'],
            'password' => $hashedPassword,
            'role' => 'user',
        ]);
    }
}
