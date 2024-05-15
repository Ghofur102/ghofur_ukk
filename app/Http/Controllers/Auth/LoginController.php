<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function process(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'UsernameOrEmail' => 'required',
            'password' => 'required|min:8',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        if(filter_var($request->UsernameOrEmail, FILTER_VALIDATE_EMAIL))
        {
            if(Auth::attempt(['email' => $request->UsernameOrEmail, 'password' => $request->password]))
            {
                return redirect()->route('dashboard')->with('success', 'Berhasil login!');
            }
        } else {
            if(Auth::attempt(['username' => $request->UsernameOrEmail, 'password' => $request->password]))
            {
                return redirect()->route('dashboard')->with('success', 'Berhasil login!');
            }
        }
        return redirect()->back()->with('error', 'Username atau password salah!');
    }
    public function logout(Request $request) {
        // untuk menghapus semua informasi otentikasi pengguna saat ini
        Auth::logout();
        // membatalkan sesi pengguna
        $request->session()->invalidate();
        // membuat ulang token csrf
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
