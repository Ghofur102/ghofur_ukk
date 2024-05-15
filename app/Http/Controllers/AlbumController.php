<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\albums;
use App\Models\photos;

class AlbumController extends Controller
{
    public function show($id)
    {
        $album = albums::findOrFail($id);
        return view('detail-album', compact('album'));
    }
    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name_album' => 'required',
            'description'=> 'required',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'name_album' => $request->name_album,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ];
        albums::create($data);
        return redirect()->back()->with('sukses', 'Data Album Berhasil Ditambahkan');
    }
    public function destroy($id)
    {
        $album = albums::findOrFail($id);
        $photos = photos::where('album_id', $id)->get();
        foreach ($photos as $photo) {
            $photo->update([
                'album_id' => null
            ]);
        }
        $album->delete();
        return response()->json([
            'success' => true,
            'count' => albums::count()
        ]);
    }
    public function update($id, Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name_album' => 'required',
            'description'=> 'required',
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'name_album' => $request->name_album,
            'description' => $request->description,
        ];
        albums::findOrFail($id)->update($data);
        return redirect()->back()->with('sukses', 'Data Album Berhasil Diupdate!');
    }
}
