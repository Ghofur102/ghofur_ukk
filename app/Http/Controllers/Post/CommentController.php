<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\comments;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $photo)
    {
        $validasi = Validator::make($request->all(), [
            'content_comment' => 'required'
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'content_comment' => $request->content_comment,
            'photo_id' => $photo,
            'user_id' => Auth::user()->id
        ];
        comments::create($data);
        return back()->with('success', 'Berhasil memberi komentar!');
    }
    public function destroy($id)
    {
        $comment = comments::findOrFail($id);
        $comment->delete();
        return response()->json([
            'success' => true,
        ]);
    }
    public function update(Request $request, $comment)
    {
        $validasi = Validator::make($request->all(), [
            'content_comment' => 'required'
        ]);
        if($validasi->fails()) {
            return redirect()->back()->with('error', $validasi->errors()->first())->withInput();
        }
        $data = [
            'content_comment' => $request->content_comment,

        ];
        comments::findOrFail($comment)->update($data);
        return back()->with('success', 'Berhasil mengupdate komentar!');
    }
}
