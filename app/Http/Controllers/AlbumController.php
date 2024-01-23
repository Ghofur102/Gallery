<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\MyAlbums;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AlbumController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $albums = Auth::user()->Post_Album;
        $myalbum = Auth::user()->My_Album;
        return view('album', compact('albums', 'myalbum'));
    }
    public function process($id)
    {
        $check = Albums::where('post_id', $id)->where('user_id', Auth::user()->id)->exists();
        if (!$check) {
            # code...
            Albums::create([
                'post_id' => $id,
                'user_id' => Auth::user()->id
            ]);
            return redirect()->back();
        } else {
            # code...
            $album = Albums::where('post_id', $id)->where('user_id', Auth::user()->id)->first();
            $album->delete();
            return redirect()->back();
        }
    }
    public function tambah_myalbum(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name_album' => 'required',
            'description_album' => 'required'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 422);
        }
        MyAlbums::create([
            'user_id' => Auth::user()->id,
            'name_album' => $request->name_album,
            'description_album' => $request->description_album
        ]);
        return response()->json([
            'success' => true
        ]);
    }
    public function index_myalbum($id)
    {
        $myalbum = MyAlbums::findOrFail($id);
        $posts = Posts::where('album_id', $id)->get();
        return view('show_myalbum', compact('myalbum', 'posts'));
    }
    public function addOrUpdate_myalbum(Request $request, $post_id)
    {
        $validate = Validator::make($request->all(), [
            'album' => 'required',
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 422);
        }
        $album = $request->album;

        $post = Posts::findOrFail($post_id);
        if ($post->album_id != null) {
            $post->album_id = null;
            $post->save();
            $post->album_id = $album;
            $post->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil memindahkan foto ke album baru.'
            ]);
        } else {
        $post->album_id = $album;
        $post->save();
        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan foto ke album.'
        ]);
        }
    }
}
