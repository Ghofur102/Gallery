<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'post_id',
        'komentar',
        'parent_id',
        'parent_main_id'
    ];
    public function Sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient() {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    public function Posts() {
        return $this->belongsTo(Posts::class, 'post_id');
    }
    public function Likes() {
        return $this->hasMany(Likes::class, 'comment_id');
    }
    public function CountLikes() {
        return Likes::where('comment_id', $this->id)->count();
    }
    public function IsLike() {
        return Likes::where('comment_id', $this->id)->where('sender_id', Auth::user()->id)->exists();
    }
    public function ReplyComment()
    {
        return Comments::where('parent_id', $this->id)->get();
    }
    public function Reply2Comment()
    {
        return Comments::where('parent_main_id', $this->id)->get();
    }
}
