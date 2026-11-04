<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek apakah email dan password cocok dengan database
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/motor'); // Arahkan ke halaman motor jika sukses
        }

        // Jika gagal, kembalikan ke halaman login bawa pesan error
        return back()->with('error', 'Email atau Password salah!');
    }

    public function loginApi(Request $request)
    {
        // 1. Cari user berdasarkan email
        $user = \App\Models\User::where('email', $request->email)->first();

        // 2. Jika email tidak ditemukan sama sekali
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak terdaftar di database!'
            ], 401); // 401 = Unauthorized
        }

        // 3. Jika email ada, kita cek apakah passwordnya cocok
        if (\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            // Cocok! Kirim data user ke Android
            return response()->json([
                'success' => true,
                'message' => 'Login Berhasil',
                'data'    => $user
            ], 200); // 200 = OK
        }

        // 4. Jika password salah
        return response()->json([
            'success' => false,
            'message' => 'Password yang Anda masukkan salah!'
        ], 401);
    }

    public function logout(\Illuminate\Http\Request $request)
    {
        // 1. Mengeluarkan (logout) user yang sedang aktif
        \Illuminate\Support\Facades\Auth::logout();

        // 2. Menghapus sesi (session) saat ini agar benar-benar bersih dan aman
        $request->session()->invalidate();

        // 3. Membuat ulang token keamanan agar tidak bisa di-back atau dibajak
        $request->session()->regenerateToken();

        // 4. Mengarahkan pengguna kembali ke halaman utama (atau halaman login)
        return redirect('/login');
    }
}
