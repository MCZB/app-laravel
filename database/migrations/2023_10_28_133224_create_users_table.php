<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->date('birthdate')->nullable(); // Adiciona a coluna birthdate do tipo date e permite valores nulos
            $table->string('country')->nullable(); // Adiciona a coluna country do tipo string e permite valores nulos
            $table->string('reset_token')->nullable(); // Adiciona a coluna reset_token do tipo string e permite valores nulos
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
