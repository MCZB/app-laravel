<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('upcoming_movies', function (Blueprint $table) {
            $table->id();
            $table->json('genre_ids');
            $table->string('original_language');
            $table->string('original_title');
            $table->text('overview');
            $table->float('popularity');
            $table->string('backdrop_path')->nullable(); // Permitir valores nulos
            $table->string('poster_path')->nullable(); // Permitir valores nulos
            $table->date('release_date')->nullable(); // Permitir valores nulos
            $table->string('title');
            $table->boolean('video');
            $table->float('vote_average');
            $table->integer('vote_count');
            $table->timestamps();
        });
    }
};