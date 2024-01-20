<?php

namespace App\Http\Controllers;

use App\Models\Likes;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function like_postingan($sender, $recipient, $post)
    {
        $check = Likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where('post_id', $post)->exists();
        if ($check) {
            // unlike
            $like = Likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where('post_id', $post)->first();
            $like->delete();
            return response()->json([
                'like' => false
            ]);
        } else {
            // like
            Likes::create([
                'sender_id' => $sender,
                'recipient_id' => $recipient,
                'post_id' => $post
            ]);
            return response()->json([
                'like' => true
            ]);
        }

    }
    public function like_comment($sender, $recipient, $comment)
    {
        $check = Likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where('comment_id', $comment)->exists();
        if ($check) {
            // unlike
            $like = Likes::where('sender_id', $sender)->where('recipient_id', $recipient)->where('comment_id', $comment)->first();
            $like->delete();
            return response()->json([
                'like' => false
            ]); 
        } else {
            // like
            Likes::create([
                'sender_id' => $sender,
                'recipient_id' => $recipient,
                'comment_id' => $comment
            ]);
            return response()->json([
                'like' => true
            ]);
        }

    }
}
