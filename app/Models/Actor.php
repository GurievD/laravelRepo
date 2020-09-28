<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'image_path'
    ];

    public function movies() {
        return $this->belongsToMany(Movie::class, 'movie_actor');
    }

    function actor_comments(){
        return $this->hasMany(ActorComment::class);
    }

    function actor_likes() {
        return $this->hasMany(ActorLike::class);
    }

    function isLikedBy(User $user) {
        return $this->actor_likes()
            ->where('user_id', $user->id)
            ->exists();
    }
}
