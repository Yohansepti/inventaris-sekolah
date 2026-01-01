<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function authenticate(Request $request)
{
    $credentials = $request->validate([
        'nama_pengguna' => 'required|string',
        'kata_sandi' => 'required|string',
    ]);

    if (Auth::attempt(['username' => $credentials['nama_pengguna'], 'password' => $credentials['kata_sandi']])) {
        $request->session()->regenerate();

        if (Auth::check()) {
            return redirect()->intended(route('dashboard'));
        }
    }

    return back()->withErrors([
        'nama_pengguna' => 'Percobaan login gagal. Pastikan password di database sudah di-hash.',
    ]);
}
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
