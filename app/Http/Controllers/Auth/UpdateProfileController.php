<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class UpdateProfileController extends Controller
{
    public function update(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'username' => 'required|max:25',
            'fullname' => 'required',
            'address' => 'required',
            'bio' => 'required',
            'photo_profile' => 'nullable|image|mimes:png,jpg,jpeg,gif,avif|max:50000'
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        if ($request->photo_profile != null) {
            # code...
            if (Auth::user()->photo_profile != null) {
                # code...
                Storage::delete(Auth::user()->photo_profile);
            }
            $photo = $request->file('photo_profile')->store('profile', 'public');
        } else {
            # code...
            $photo = Auth::user()->photo_profile;
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->username = $request->username;
        $user->fullname = $request->fullname;
        $user->address = $request->address;
        $user->bio = $request->bio;
        $user->photo_profile = $photo;
        $user->save();
        return redirect()->back()->with('success', 'Profile berhasil diubah');
    }
}
