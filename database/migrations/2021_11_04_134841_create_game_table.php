<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id('game_id');
            $table->string('name');
            $table->longText('description');
            $table->longText('description_long');
            $table->string('category');
            $table->string('developer');
            $table->string('publisher');
            $table->double('price');
            $table->date('release_date');
            $table->string('cover');
            $table->string('trailer');
            $table->boolean('adult');
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
        Schema::dropIfExists('games');
    }
}
