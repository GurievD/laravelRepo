<?php

use App\Models\Actor;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActorCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->foreignIdFor(User::class)
                ->constrained()
                ->onDelete('cascade');

            $table->foreignIdFor(Actor::class)
                ->constrained()
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_comments');
    }
}
