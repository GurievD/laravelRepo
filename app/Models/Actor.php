<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    public $fillable = [
        'actor_name', 'birth_date', 'image_path'
    ];

    function movies() {
        return $this->hasMany(Movie::class);
    }
}
