<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";
    protected $fillable = [
        'user_id',
        'gambar',
        'judul_gambar',
        'deskripsi_gambar',
        'slug'
    ];
    public function User() {
        return $this->belongsTo(User::class, 'user_id');
    } 
    public function Likes() {
        return $this->hasMany(Likes::class, 'post_id');
    }
    public function Count_Likes() {
        return Likes::where('post_id', $this->id)->count();
    }
    public function Is_Like() {
        return Likes::where('post_id', $this->id)->where('sender_id', Auth::user()->id)->exists();
    }
    public function Comments() {
        return $this->hasMany(Comments::class, 'post_id');
    }
    public function User_Album() {
        return $this->belongsToMany(User::class, 'albums', 'post_id', 'user_id');
    }
    public function IsInAlbum() {
        return Albums::where('post_id', $this->id)->where('user_id', Auth::user()->id)->exists();
    }
}
