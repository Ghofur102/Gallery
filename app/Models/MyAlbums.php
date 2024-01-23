<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyAlbums extends Model
{
    use HasFactory;
    protected $table = "my_albums";
    protected $fillable = [
        "user_id",
        "name_album",
        "description_album"
    ];
    public function User()
    {
        return $this->belongsTo(User::class, "user_id");
    }
    public function Posts()
    {
        return $this->hasMany(Posts::class, "album_id");
    }
    public function check_post($id)
    {
        $post = Posts::findOrFail($id);
        if ($post->album_id == $this->id) {
            return true;
        } else {
            return false;
        }

    }
}
