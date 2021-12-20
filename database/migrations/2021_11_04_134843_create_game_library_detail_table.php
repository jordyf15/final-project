<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGameLibraryDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_library_details', function (Blueprint $table) {
            $table->unsignedBigInteger('library_id');
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id')->references('game_id')->on('games');
            $table->foreign('library_id')->references('library_id')->on('game_libraries');
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
        Schema::dropIfExists('game_library_details');
    }
}
