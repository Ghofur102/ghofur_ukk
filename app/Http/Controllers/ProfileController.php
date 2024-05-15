<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function other_profile($id)
    {
        $other = User::findOrFail($id);
        if(Auth::check())
        {
            if(Auth::user()->id == $id)
            {
                return redirect('/profile');
            }
        }
        return view('other-profile', compact('other'));
    }
}
