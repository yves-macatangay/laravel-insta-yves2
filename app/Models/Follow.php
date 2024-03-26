<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    public $timestamps = false;

    //follow belongs to user (followed)
    public function followed(){
        return $this->belongsTo(User::class, 'followed_id')->withTrashed();
    }

    //follower belongs to user (follower)
    public function follower(){
        return $this->belongsTo(User::class, 'follower_id')->withTrashed();
    }
}
