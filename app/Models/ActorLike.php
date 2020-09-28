<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorLike extends Model
{

    protected $fillable = [
        'actor_id', 'user_id'
    ];

}
