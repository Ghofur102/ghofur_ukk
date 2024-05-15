<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
    public function forget_password()
    {
        return view('auth.forgot-password');
    }
    function process_forget_password(Request $request) {
        $validasi = Validator::make($request->all(), [

            'email' => 'required|email'
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('email', $validasi->errors()->first())->withInput();
        }

        // otomatis mengirim email berisi link ke halaman reset password, dan hanya menerima request email untuk mengirim email
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // mengecek status, jika RESET_LINK_SENT maka terdeteksi sudah berhasil mengirim email
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }
    function reset_password(string $token) {
        return view('auth.reset-password', ['token' => $token]);
    }
    function process_reset_password(Request $request) {
        $validasi = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }

        // Password::reset berisi method untuk reset password secara otomatis bawaan laravel,
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    public function change_password(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $check = Hash::check($request->current_password, Auth::user()->password);
        if ($check) {
            # code...
            $user = User::findOrFail(Auth::user()->id);
            $user->password = $request->new_password;
            $user->save();
            return redirect()->back()->with('success', 'Password Berhasil Diubah');
        } else {
            # code...
            return redirect()->back()->with('error', 'Current Password not matched with your password!');
        }

    }
}
