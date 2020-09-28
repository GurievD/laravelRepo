<?php

use App\Models\Actor;
use App\Models\Movie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovieActorTable extends Migration
{
    public function up()
    {
        Schema::create('movie_actor', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Movie::class)
                ->constrained()
                ->onDelete('cascade');

            $table->foreignIdFor(Actor::class)
                ->constrained()
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movie_actor');
    }
}
