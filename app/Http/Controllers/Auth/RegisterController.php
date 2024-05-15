<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }
    public function process(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'username' => 'required|max:25',
            'password' => 'required|min:8',
            'email' => 'required|email|unique:users',
            'fullname' => 'required',
            'address' => 'required'
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'username' => $request->username,
            'password' => $request->password,
            'email' => $request->email,
            'fullname' => $request->fullname,
            'address' => $request->address,
        ];
        User::create($data);
        return redirect()->route('login')->with('success', 'Berhasil register, silakan login!');
    }
}
