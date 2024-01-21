<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $count_posts = Posts::where('user_id', Auth::user()->id)->count();
        return view('profile', compact('count_posts'));
    }
    public function profile_oranglain($id)
    {
        $user = User::findOrFail($id);
        $count_posts = Posts::where('user_id', $id)->count();
        return view('profile_oranglain', compact('user', 'count_posts'));
    }
}
