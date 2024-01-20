<?php

namespace App\Http\Controllers;

use App\Models\Albums;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlbumController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $albums = Auth::user()->Post_Album;
        return view('album', compact('albums'));
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
}
