<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // ======= HALAMAN LOGIN =======
    public function showLogin()
    {
        return view('auth.login');
    }

    // ======= PROSES LOGIN =======
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // Cek kredensial
        if (Auth::attempt($request->only('email', 'password'))) {

            // Jika ADMIN
            if (Auth::user()->role === 'admin') {
                return redirect('/admin/dashboard');
            }

            // Jika USER BIASA
            return redirect('/user/dashboard');
        }

        return back()->with('error', 'Email atau password salah');
    }

    // ======= HALAMAN REGISTER =======
    public function showRegister()
    {
        return view('auth.register');
    }

    // ======= PROSES REGISTER USER =======
    public function register(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|unique:users,email',
            'password'  => 'required|min:6',
            'phone'     => 'nullable',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'password'  => Hash::make($request->password),
            'role'      => 'user'   // register default user
        ]);

        return redirect('/login')->with('success', 'Berhasil daftar, silakan login.');
    }

    // ======= LOGOUT =======
    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah berhasil logout.');
    }
}
