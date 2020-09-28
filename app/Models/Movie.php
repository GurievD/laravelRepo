<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $fillable = [
        'name', 'description', 'release_date', 'genre_id', 'image_path'
    ];



    public function genre() {
        return $this->belongsTo(Genre::class);
    }

    public function actors() {
        return $this->belongsToMany(Actor::class, 'movie_actor');
    }

    function movie_comments(){
        return $this->hasMany(MovieComment::class);
    }

    function movie_likes() {
        return $this->hasMany(MovieLike::class);
    }

    function isLikedBy(User $user) {
        return $this->movie_likes()
            ->where('user_id', $user->id)
            ->exists();
    }
}
