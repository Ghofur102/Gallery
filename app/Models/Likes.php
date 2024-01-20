<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'post_id',
        'comment_id'
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
    public function Comment() {
        return $this->belongsTo(Comments::class, 'comment_id');
    }
}
