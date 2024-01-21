<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'foto_profil',
        'tentang'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function Posts() {
        return $this->hasMany(Posts::class, 'user_id');
    }
    public function Sender_Likes() {
        return $this->hasMany(Likes::class, 'sender_id');
    }
    public function Recipient_Likes() {
        return $this->hasMany(Likes::class, 'recipient_id');
    }
    public function Sender_Comments() {
        return $this->hasMany(Comments::class, 'sender_id');
    }
    public function Recipient_Comments() {
        return $this->hasMany(Comments::class, 'recipient_id');
    }
    public function Post_Album() {
        return $this->belongsToMany(Posts::class, 'albums', 'user_id', 'post_id');
    }
    public function Count_Photos() {
        return Posts::where('user_id', $this->id)->count();
    }
}
