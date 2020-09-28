<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovieComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'movie_id', 'content'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function movie() {
        return $this->belongsTo(Movie::class);
    }

}
