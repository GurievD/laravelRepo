<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $fillable = [
        'movie_name', 'description', 'genre_id', 'release_date', 'image_path'
    ];

    public function genre() {
        return $this->belongsTo(Genre::class);
    }
}
