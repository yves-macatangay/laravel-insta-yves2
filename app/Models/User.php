<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    CONST ADMIN_ROLE_ID = 1;
    CONST USER_ROLE_ID = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    //user has many posts
    public function posts(){
        return $this->hasMany(Post::class);
    }

    //user has many comments
   //not needed yet

   //user (follower) has many follows
   public function follows(){
        return $this->hasMany(Follow::class, 'follower_id');
   }

   //user is being followed by many users
   public function followers(){
        return $this->hasMany(Follow::class, 'followed_id');
   }

   //is $this user already followed? (are we already following $this user)
   public function isFollowed(){
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();
        //$this->followers() - look at $this user's list of followers
        //where() - in the list of followers, is the logged-in user there?
        //exists() - if where() finds anything, return true

   }
}
