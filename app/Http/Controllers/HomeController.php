<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Posts::where('user_id', Auth::user()->id)->get();
        return view('home', compact('posts'));
    }
    public function home()
    {
        $posts = Posts::all();
        $post_first = Posts::first();
        $posts_count = Posts::count();
        return view('welcome', compact('posts', 'post_first', 'posts_count'));
    }
    public function profile_update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'foto_profil' => 'nullable|image|mimes:png,jpg,jpeg,avif,gif|max:50000',
            'tentang' => 'required|max:225'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 422);
        }
        $user = User::findOrFail($id);
        if ($request->foto_profil != null) {
            if ($user->foto_profil != null) {
                Storage::delete($user->foto_profil);
            }
            $user->foto_profil = $request->file('foto_profil')->store('foto-user', 'public');
        }
        $user->tentang = $request->tentang;
        $user->save();
        return response()->json([
            'success' => true,
        ]);
    }
}
