<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        Log::info('=== LOGIN DIMULAI ===');

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        Log::info('Input Login', [
            'username' => $request->username,
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];

        Log::info('Mencoba Auth::attempt()');

        if (Auth::attempt($credentials)) {

            Log::info('LOGIN BERHASIL');

            $request->session()->regenerate();

            Log::info('Session ID', [
                'session_id' => session()->getId(),
                'auth_check' => Auth::check(),
                'user' => Auth::user(),
            ]);

            return redirect()->route('dashboard');
        }

        Log::warning('LOGIN GAGAL');

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->onlyInput('username');
    }
}