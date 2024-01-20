<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:png,jpg,jpeg,gif,avif|max:50000',
            'judul_gambar' => 'required',
            'deskripsi_gambar' => 'required|max:225'
        ]);
        Posts::create([
            'user_id' => Auth::user()->id,
            'gambar' => $request->file('gambar')->store('postingan', 'public'),
            'judul_gambar' => $request->judul_gambar,
            'deskripsi_gambar' => $request->deskripsi_gambar,
            'slug' => Str::uuid()
        ]);
        return redirect()->back()->with('success', 'Sukses menambahkan postingan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg,gif,avif|max:50000',
            'judul_gambar' => 'required',
            'deskripsi_gambar' => 'required|max:225'
        ]);
        if ($validate->fails()) {
            return response()->json($validate->errors()->first(), 422);
        }
        $post = Posts::findOrFail($id);
        if ($request->hasFile('gambar')) {
            Storage::delete($post->gambar);
            $post->gambar = $request->file('gambar')->store('postingan', 'public');
        }
        $post->judul_gambar = $request->judul_gambar;
        $post->deskripsi_gambar = $request->deskripsi_gambar;
        $post->save();
        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Posts::findOrFail($id);
        Storage::delete($post->gambar);
        $post->delete();
        return redirect()->back()->with('success', 'Sukses menghapus data gambar!');
    }
}
