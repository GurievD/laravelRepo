<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActorComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'actor_id', 'content'
    ];

    function user() {
        return $this->belongsTo(User::class);
    }

    function actor() {
        return $this->belongsTo(Actor::class);
    }

}
