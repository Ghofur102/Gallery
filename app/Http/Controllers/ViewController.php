<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;

class ViewController extends Controller
{
    public function gallery()
    {
        $posts = Posts::all();
        return view('gallery', compact('posts'));
    }
    public function show_post($slug)
    {
        $post = Posts::where('slug', $slug)->first();
        if (!$post) {
            abort('404');
        }
        $posts = Posts::inRandomOrder()->take(3)->whereNot('slug', $slug)->get();
        return view('show_post', compact('post', 'posts'));
    }
    public function profile()
    {
        return view('profile');
    }
    public function profile_oranglain($id)
    {
        $user = User::findOrFail($id);
        return view('profile_oranglain', compact('user'));
    }
}
