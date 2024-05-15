<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\likes;
use App\Models\photos;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($photo)
    {
        $check = likes::where('user_id', Auth::user()->id)->where('photo_id', $photo)->exists();
        if ($check) {
            likes::where('user_id', Auth::user()->id)->where('photo_id', $photo)->delete();
            $foto = photos::findOrFail($photo);
            $foto->count_like -= 1;
            $foto->save();
        } else {
            likes::create([
                'user_id' => Auth::user()->id,
                'photo_id' => $photo
            ]);
            $foto = photos::findOrFail($photo);
            $foto->count_like += 1;
            $foto->save();
        }
        return back();
    }
}
