<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->double('price');
            $table->unsignedBigInteger('transaction_header_id');
            $table->unsignedBigInteger('game_id');
            $table->foreign('transaction_header_id')->references('transaction_header_id')->on('transaction_headers');
            $table->foreign('game_id')->references('game_id')->on('games');
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
        Schema::dropIfExists('transaction_details');
    }
}
