<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\support\Facades\Hash;

class DaftarController extends Controller
{
    public function index()
    {
        return view('auth.daftar');
    }

    public function store(UserRequest $request)
    {
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Akun berhasil dibuat.');
    }
}