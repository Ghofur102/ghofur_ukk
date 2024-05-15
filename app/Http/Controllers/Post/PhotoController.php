<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\photos;

class PhotoController extends Controller
{
    public function index($type)
    {
       if ($type === 'all') {
        # code...
        $photos = photos::inRandomOrder()->get();
       } else if($type === 'latest') {
        $photos = photos::orderBy('created_at', 'desc')->get();
       } else if($type === 'longest') {
        $photos = photos::orderBy('created_at', 'asc')->get();
       } else if($type === 'likes') {
        $photos = photos::has('likes')->orderBy('count_like', 'desc')->get();
       }
       else {
        return redirect('/gallery/all');
       }
        return view('all-photos', compact('photos'));
    }
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name_photo' => 'required',
            'description_photo'=> 'required',
            'location_file' => 'required|image|mimes:png,jpg,jpeg,gif,avif|max:50000',
            'album_id' => 'nullable',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'name_photo' => $request->name_photo,
            'description_photo' => $request->description_photo,
            'location_file' => $request->file('location_file')->store('photos', 'public'),
            'user_id' => Auth::user()->id,
            'album_id' => $request->album_id,
        ];
        photos::create($data);
        return back()->with('success', 'Berhasil memosting!');
    }
    public function destroy($id)
    {
        $photo = photos::findOrFail($id);
        Storage::delete($photo->location_file);
        $photo->delete();
        return response()->json([
            'success' => true,
            'count' => photos::count()
        ]);
    }
    public function update($id, Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name_photo' => 'required',
            'description_photo'=> 'required',
            'album_id' => 'nullable',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'name_photo' => $request->name_photo,
            'description_photo' => $request->description_photo,
            'album_id' => $request->album_id,
        ];
        $photo = photos::findOrFail($id);
        $photo->update($data);
        return back()->with('success', 'Berhasil mengupdate!');

    }
    public function show($id)
    {
        $photo = photos::findOrFail($id);
        $other_photo = photos::where('user_id', $photo->user_id)->take(3)->get();
        return view('postingan', compact('photo', 'other_photo'));
    }
}
