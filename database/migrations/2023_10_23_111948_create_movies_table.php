<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('original_language');
            $table->string('original_title');
            $table->text('overview');
            $table->float('popularity');
            $table->string('poster_path')->nullable();
            $table->date('release_date');
            $table->string('title');
            $table->boolean('video');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
