<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
            # code...
            $comment = Comments::create([
                'sender_id' => $request->sender_id,
                'recipient_id' => $request->recipient_id,
                'komentar' => $request->comment,
                'post_id' => $request->post_id,
                'parent_id' => $request->parent_id,
                'parent_main_id' => $request->parent_main_id
            ]);
            return response()->json([
                'komentar' => $request->comment,
                'id' => $comment->id,
                'recipient_id' => $comment->Sender->id,
                'post_id' => $comment->post_id,
                'parent_id' => $comment->parent_id,
                'parent_main_id' => $comment->parent_main_id,
                'recipient_name' => $comment->Recipient->name,
                'foto_sender' => $comment->Sender->foto_profil
            ]);


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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
